<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\AttemptQuestion;
use App\Models\Classroom;
use App\Models\ClassroomGroup;
use App\Models\User;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function getOwnStudents()
    {
        try {
            $userID = auth()->guard('api')->id();
            $userIDS = Classroom::whereIn('class_id', ClassroomGroup::where('teacher_id', $userID)->pluck('id'))->pluck('id', 'student_id')->toArray();
            $students = User::whereIn('id', array_keys($userIDS))->with(['classRooms.classroom_group' => function ($query) use ($userID) {
                $query->where('teacher_id', $userID);
            }])->get();
            return response()->json(new ResponseJSON(status: true, data: $students));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function getStats($id)
    {
        try {
            $user = User::find($id);
            $attempt_ids = Attempt::where(["user_id" => $user->id])->pluck("id", "id")->toArray();
            $attempt_count = Attempt::where(["user_id" => $user->id])->count();
            $attempt_count_unfinished = Attempt::where(["user_id" => $user->id, "end_at" => null])->count();
            $attempt_question_count = AttemptQuestion::whereHas("attempt_subject", function ($q) use ($attempt_ids) {
                $q->whereIn('attempt_id', $attempt_ids);
            })->pluck("question_id", "question_id")->count();
            $average_unt_count = Attempt::where(["user_id" => $user->id, "type_id" => 2])->avg("points");
            $stat_by_week = Attempt::whereBetween("start_at", [Carbon::now()->addDays(-7), Carbon::now()])
                ->select(DB::raw('DATE(start_at) as date'), DB::raw('avg(points) as points'))
                ->groupBy('date')
                ->pluck("points", "date")->toArray();
            foreach (Attempt::where(["user_id" => $user->id, "end_at" => null])->get() as $attempt) {
                $time = $attempt->start_at->addMilliseconds($attempt->time);
                if ($time <= Carbon::now()) {
                    $attempt->update(["end_at" => $time]);
                    $attempt->save();
                } else {
                    $attempt->update(['time_left' => $attempt->time - Carbon::now()->diffInMilliseconds($attempt->start_at)]);
                }
            }
            $results = Attempt::where(["user_id" => $user->id])->orderBy("start_at", "DESC")->with("attempt_type", "locale", "subjects")->paginate(5);
            $data = [
                "attempt_count" => $attempt_count,
                "attempt_count_unfinished" => $attempt_count_unfinished,
                "attempt_question_count" => $attempt_question_count,
                "average" => round($average_unt_count),
                "stat_by_week" => $stat_by_week,
                "results" => $results
            ];
            return response()->json(new ResponseJSON(status: true, data: $data), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
