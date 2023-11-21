<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\AnnouncementGroup;
use App\Models\Notification;
use App\Models\NotificationUserStatus;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index(){
        try{
            $user = auth()->guard("api")->user();
            $announcements = AnnouncementGroup::where(["is_active" => true])
            ->where("start_date","<=",Carbon::now())
            ->where("end_date",">=",Carbon::now())
            ->withCount("announcements")
            ->with(["announcements","file"])->get()->where("announcements_count",">",0);
            return response()->json(new ResponseJSON(status: true,data: $announcements
            ),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
