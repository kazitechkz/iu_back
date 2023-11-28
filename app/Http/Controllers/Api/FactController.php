<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fact;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class FactController extends Controller
{
    public function getFactsBySubjectID($subjectID)
    {
        try {
            $fact = Fact::with('subject.image')->where('subject_id', $subjectID)->inRandomOrder()->limit(1)->first();
            return response()->json(new ResponseJSON(
                status: true,
                data: $fact
            ));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
