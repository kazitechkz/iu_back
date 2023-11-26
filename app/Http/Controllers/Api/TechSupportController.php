<?php

namespace App\Http\Controllers\Api;

use App\DTOs\CreateTechSupportTicketDTO;
use App\Http\Controllers\Controller;
use App\Models\TechSupportCategory;
use App\Models\TechSupportMessage;
use App\Models\TechSupportTicket;
use App\Models\TechSupportType;
use App\Services\ResponseService;
use App\Services\TechSupportService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class TechSupportController extends Controller
{
    private TechSupportService $techSupportService;
    public function __construct(TechSupportService $_techSupportService){
        $this->techSupportService = $_techSupportService;
    }
    public function getTechSupportTypes(){
        try{
            $techSupportTypes = TechSupportType::all();
            return response()->json(new ResponseJSON(status: true,data: $techSupportTypes),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
    public function getTechSupportCategories(){
        try{
            $techSupportCategories = TechSupportCategory::all();
            return response()->json(new ResponseJSON(status: true,data: $techSupportCategories),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function myTechSupportTickets(Request $request){
        try{
            $user = auth()->guard("api")->user();
            $condition = ["user_id"=>$user->id];
            $myTechSupportTickets = TechSupportTicket::query();
            if($request->exists("is_closed")){
                $condition["is_closed"] = $request->boolean("is_closed");
            }
            if($request->exists("is_resolved")){
                $condition["is_resolved"] = $request->boolean("is_resolved");
            }
            if($request->exists("type_id")){
                $condition["type_id"] = $request->get("type_id");
            }
            if($request->exists("category_id")){
                $condition["category_id"] = $request->get("category_id");
            }
            $myTechSupportTickets = $myTechSupportTickets->where($condition);
            if($request->get("search")){
                $myTechSupportTickets = $myTechSupportTickets->
                where("title","LIKE","%".$request->get("search")."%");
            }
            $myTechSupportTickets = $myTechSupportTickets->with(["tech_support_category","tech_support_type"])
                                                            ->withCount("tech_support_messages")->paginate(12);
            return response()->json(new ResponseJSON(status: true,data: $myTechSupportTickets),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
    public function getTicketById(Request $request,$id){
        try{
            $user = auth()->guard("api")->user();
            $ticket = TechSupportTicket::where(["user_id"=>$user->id,"id"=>$id])->with(["tech_support_category","tech_support_type"])->first();
            if(!$ticket){
                return ResponseService::NotFound("Не найден тикет");
            }
            $messages = TechSupportMessage::where(["ticket_id"=>$ticket->id])->with(["tech_support_files.file","user"])->orderBy("created_at","desc")->paginate(20);
            $result = ["ticket"=>$ticket,"messages"=>$messages];
            return response()->json(new ResponseJSON(status: true,data: $result),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
    public function createTechSupportTickets(Request $request){
        try{
            $ticket = $this->techSupportService->createTechSupportTicket($request);
            return response()->json(new ResponseJSON(status: true,data: $ticket),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function closeTechSupportTickets(Request $request){
        try{
            $ticket = $this->techSupportService->closeTicket($request);
            return response()->json(new ResponseJSON(status: true,data: $ticket),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
    public function createTechSupportMessage(Request $request){
        try{
            $ticketMessage = $this->techSupportService->createTechSupportMessage($request);
            return response()->json(new ResponseJSON(status: true,data: $ticketMessage),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
