<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\NotificationType;
use App\Models\NotificationUserStatus;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getNewMessageCount(){
        try{
            $user = auth()->guard("api")->user();
            $notifications = Notification::query();
            $read_ids = NotificationUserStatus::where(["user_id" =>$user->id])->get()->pluck("notification_id","notification_id")->toArray();
            if(count($read_ids)){
                $notifications = $notifications->whereNotIn("id",$read_ids);
            }
            $notifications = $notifications->whereJsonContains("users",$user->id)->count();
            return response()->json(new ResponseJSON(status: true,data: $notifications),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function getNotifications(Request $request){
        try{
            $condition = [];
            $user = auth()->guard("api")->user();
            $notifications = Notification::query();
            if($request->get("notification_type")){
                if($request->get('notification_type') == "all"){
                    $notifications = $notifications->where(["users"=>null,"class_id"=>null]);
                }
            }
            else{
               $notifications = $notifications->whereJsonContains("users",$user->id);
            }

            if($request->get("type_id")){
               $condition = [...$condition,"type_id"=>$request->get("type_id")];
            }
            if($request->get("status") == "new"){
                $read_ids = NotificationUserStatus::where(["user_id" =>$user->id])->pluck("notification_id")->toArray();
                if(count($read_ids)){
                    $notifications = $notifications->whereNotIn("id",$read_ids);
                }
            }
            if($request->get("search")){
                $notifications = $notifications->where('title',"LIKE","%" . $request->get("search") ."%")->orWhere("message","LIKE","%" . $request->get("search") ."%");
            }
            $notifications = $notifications->where($condition)
                ->with(["owner","notification_type"])
                ->orderBy("created_at","desc")
                ->paginate(20);
            return response()->json(new ResponseJSON(status: true,data: $notifications),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function getUserReadMessagesIds(){
        try{
            $user = auth()->guard("api")->user();
            $read_ids = NotificationUserStatus::where(["user_id" =>$user->id])->get()->pluck("notification_id")->toArray();
            return response()->json(new ResponseJSON(status: true,data: $read_ids),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function checkNotification($id){
        try{
            $user = auth()->guard("api")->user();
            $notification = NotificationUserStatus::where(["user_id" =>$user->id,"notification_id" => $id])->first();
            if(!$notification){
                NotificationUserStatus::add(["user_id" =>$user->id,"notification_id" => $id,"is_read"=>true]);
            }
            return response()->json(new ResponseJSON(status: true,data: true),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function getNotificationTypes(){
        try{
            $notification_types = NotificationType::all();
            return response()->json(new ResponseJSON(status: true,data: $notification_types),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

}
