<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\GroupPlan;
use App\Models\Question;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class QuestionController extends Controller
{
    public function getSingleSubjectTest(Request $request)
    {
        try {
            $this->validate($request, [
                'subject_id' => 'required|exists:subjects,id',
                'locale_id' => 'required|exists:locales,id',
                'count_questions' => 'required'
            ]);
            $user = auth()->user();
            if (count($user->activeSubscriptions()) > 0) {
                $planId = $user->activeSubscriptions()->pluck('id', 'plan_id');
                $group = GroupPlan::whereIn("plan_id",$planId)->pluck("group_id","group_id");
                $questions = Question::where(['subject_id' => $request['subject_id'], 'locale_id' => $request['locale_id']])
                    ->whereIn("group_id",$group)
                    ->limit($request['count_questions'])
                    ->paginate(1);
                return response()->json(new ResponseJSON(
                    status: true,
                    data: $questions
                ));
            } else {
                $questions = Question::where(['subject_id' => $request['subject_id'], 'locale_id' => $request['locale_id']])
                    ->where("group_id",2)
                    ->limit($request['count_questions'])
                    ->paginate(1);
                return response()->json(new ResponseJSON(
                    status: true,
                    data: $questions
                ));
            }
        } catch (ValidationException $ex) {
            return response()->json(new ResponseJSON(
                status: false,
                errors: $ex->errors()
            ));
        }
    }
}
