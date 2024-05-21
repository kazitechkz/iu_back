<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UrlPage;
use App\Models\Utm;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UtmController extends Controller
{
    public function saveUtm(Request $request)
    {
        try {
            $today = Carbon::today()->format('Y-m-d');
            $url = UrlPage::firstWhere('url', $request['url']);
            if ($url) {
                $utm = Utm::where(['page_id' => $url->id, 'visit_date' => $today])->first();
                if ($utm) {
                    $utm->count++;
                    $utm->save();
                } else {
                    Utm::create(['visit_date' => $today, 'page_id' => $url->id, 'count' => 1]);
                }
            }
            return response()->json(new ResponseJSON(status: true, data: true
            ));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
