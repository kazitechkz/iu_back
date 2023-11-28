<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TechSupportTicket\TechSupportTicketCreateRequest;
use App\Models\TechSupportMessage;
use App\Models\TechSupportTicket;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Ticket;

class TechSupportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            if(auth()->user()->can("tech-support index") ){
                return view("admin.tech-support-ticket.index");
            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TechSupportTicketCreateRequest $request)
    {
        try{
            if(auth()->user()->can("tech-support edit") ){
              $input = $request->all();
              $input["user_id"] = auth()->user()->id;
              TechSupportMessage::add($input);
               $tech = TechSupportTicket::find($input["ticket_id"]);
               $tech->is_answered = true;
              if($request->exists("is_closed")){
                  $tech->is_closed = $request->boolean("is_closed");
              }
                if($request->exists("is_resolved")){
                    $tech->is_resolved = $request->boolean("is_resolved");
                }
                $tech->save();
                return redirect()->back();
            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            if(auth()->user()->can("tech-support edit") ){
                $techSupportTicket = TechSupportTicket::find($id);
                return view("admin.tech-support-ticket.edit",compact("techSupportTicket"));
            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
