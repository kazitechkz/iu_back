<?php

namespace App\Http\Controllers\Api;

use App\DTOs\AnswerDTO;
use App\DTOs\AttemptCreateDTO;
use App\DTOs\AttemptCustomizeCreateDTO;
use App\DTOs\AttemptDTO;
use App\DTOs\AttemptSettingsCreateDTO;
use App\DTOs\AttemptSettingsUNTCreateDTO;
use App\DTOs\SubjectQuestionDTO;
use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\AttemptQuestion;
use App\Models\AttemptSetting;
use App\Models\AttemptSettingsResult;
use App\Models\AttemptSettingsResultsUnt;
use App\Models\AttemptSettingsUnt;
use App\Models\AttemptSubject;
use App\Models\AttemptType;
use App\Models\CommercialGroupPlan;
use App\Models\Question;
use App\Models\Subject;
use App\Models\UserQuestion;
use App\Services\AnswerService;
use App\Services\AttemptService;
use App\Services\NotificationService;
use App\Services\PlanService;
use App\Services\QuestionService;
use App\Services\ResponseService;
use App\Services\RoleServices;
use App\Traits\ResponseJSON;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AttemptController extends Controller
{
    private readonly AttemptService $attemptService;
    private readonly QuestionService $questionService;
    private readonly AnswerService $answerService;
    private readonly PlanService $planService;

    public function __construct(AttemptService $attemptService, QuestionService $questionService, AnswerService $answerService, PlanService $planService)
    {
        $this->attemptService = $attemptService;
        $this->questionService = $questionService;
        $this->answerService = $answerService;
        $this->planService = $planService;
    }


    public function attempt(Request $request)
    {
        try {
            $attempt = AttemptCreateDTO::fromRequest($request);
            $user = auth()->guard("api")->user();
            $questions = $this->questionService->get_questions_with_subjects($attempt->subjects, $attempt->locale_id, $attempt->attempt_type_id);
            $max_points = $this->questionService->get_questions_max_point($questions);
            $max_time = $this->questionService->get_max_time_in_ms($questions,$type_id = QuestionService::UNT_TYPE);
            $attempt = $this->attemptService->create_attempt($user->id, $attempt->attempt_type_id, $attempt->locale_id, $max_points, $questions, $max_time);
            return response()->json(new ResponseJSON(status: true, data: $attempt), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function attemptTypes()
    {
        try {
            $attemptTypes = AttemptType::all();
            return response()->json(new ResponseJSON(status: true, data: $attemptTypes), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function attemptByPromoCode($promo_code)
    {
        try {
            $attempt_setting = AttemptSetting::firstWhere(["promo_code" => $promo_code]);
            if ($attempt_setting) {
                $user = auth()->guard("api")->user();
                if ($attempt_setting->users) {
                    if (!$attempt_setting->isUserIncluded()) {
                        return response()->json(new ResponseJSON(status: true, message: "У вас нет прав"), 403);
                    }
                }
                if ($attempt_setting->class_id) {
                    if ($user->inIsClassroom($attempt_setting->class_id)) {
                        return response()->json(new ResponseJSON(status: true, message: "У вас нет прав"), 403);
                    }
                }
                if (AttemptSettingsResult::where(["setting_id" => $attempt_setting->id, "user_id" => $user->id])->exists()) {
                    return response()->json(new ResponseJSON(status: true, message: "Вы уже проходили данный тест"), 400);
                }
                $questions = $this->questionService->getQuestionBySettingsId($attempt_setting->id);
                $max_points = $this->questionService->get_questions_max_point($questions);
                $max_time = $this->questionService->get_time_in_ms($attempt_setting->time);
                $attempt_setting->edit(["point" => $max_points]);
                $attemptDTO = $this->attemptService->create_attempt($user->id, QuestionService::SETTINGS_TYPE, $attempt_setting->locale_id, $max_points, $questions, $max_time);
                AttemptSettingsResult::add(["attempt_id" => $attemptDTO["attempt_id"], "setting_id" => $attempt_setting->id, "user_id" => $user->id]);
                $attempt = Attempt::find($attemptDTO["attempt_id"]);
                return response()->json(new ResponseJSON(status: true, data: $attempt), 200);
            }
            //UNT
            $attempt_setting = AttemptSettingsUnt::firstWhere(["promo_code" => $promo_code]);
            if ($attempt_setting) {
                $user = auth()->guard("api")->user();
                if ($attempt_setting->users) {
                    if (!$attempt_setting->isUserIncluded()) {
                        return response()->json(new ResponseJSON(status: true, message: "У вас нет прав"), 403);
                    }
                }
                if ($attempt_setting->class_id) {
                    if ($user->inIsClassroom($attempt_setting->class_id)) {
                        return response()->json(new ResponseJSON(status: true, message: "У вас нет прав"), 403);
                    }
                }
                if (AttemptSettingsResultsUnt::where(["setting_id" => $attempt_setting->id, "user_id" => $user->id])->exists()) {
                    return response()->json(new ResponseJSON(status: true, message: "Вы уже проходили данный тест"), 400);
                }
                $questions = $this->questionService->get_questions_with_subjects(
                    subjects: $attempt_setting->subjects->pluck("id")->toArray(),
                    locale_id: $attempt_setting->locale_id,
                    attempt_type_id: QuestionService::SETTINGS_TYPE_UNT
                );
                $max_points = $this->questionService->get_questions_max_point($questions);
                $max_time = $this->questionService->get_time_in_ms($attempt_setting->time);
                $attempt_setting->edit(["point" => $max_points]);
                $attemptDTO = $this->attemptService->create_attempt($user->id, QuestionService::SETTINGS_TYPE_UNT, $attempt_setting->locale_id, $max_points, $questions, $max_time);
                AttemptSettingsResultsUnt::add(["attempt_id" => $attemptDTO["attempt_id"], "setting_id" => $attempt_setting->id, "user_id" => $user->id]);
                $attempt = Attempt::find($attemptDTO["attempt_id"]);
                return response()->json(new ResponseJSON(status: true, data: $attempt), 200);
            }
            return response()->json(new ResponseJSON(status: true, message: "По промокоду ничего не найдено"), 404);

        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }


    }

    public function createAttemptSettings(Request $request)
    {
        try {
            $user = auth()->guard("api")->user();
            $input = $request->all();
            if(count($input["users"]) == 1){
                $input["users"][0] = intval($input["users"][0]);
            }
            if ($user->hasRole(RoleServices::STUDENT_ROLE_NAME)) {
                if (!$this->planService->check_user_subject_for_attempt_settings($request->get("subject_id"))) {
                    return response()->json(new ResponseJSON(status: true, message: "У вас нет прав"), 403);
                }
                $input["class_id"] = null;
                $input["users"] = [$user->id];
            }
            if (!$this->questionService->isValidSettings($input["settings"])) {
                return response()->json(new ResponseJSON(status: true, message: "Неверное кол-во вопросов"), 400);
            }
            $input["point"] = 0;
            $input["promo_code"] = Str::random(10);
            $input["owner_id"] = auth()->guard("api")->id();
            $attemptDto = AttemptSettingsCreateDTO::fromArray($input);
            $resultDTO = $attemptDto->toArray();
            $setting = AttemptSetting::add($resultDTO);
            if ($user->hasRole(RoleServices::TEACHER_ROLE_NAME)) {
                NotificationService::createNotification($setting);
            }
            return response()->json(new ResponseJSON(status: true, data: $setting), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function createAttemptSettingsUNT(Request $request)
    {
        try {
            $user = auth()->guard("api")->user();
            $data = json_decode($request->get("data"), true);
            if ($data) {
                foreach ($data as $dataItem) {
                    $input = $dataItem;
                    $input["promo_code"] = Str::random(10);
                    $input["sender_id"] = $user->id;
                    $attemptDto = AttemptSettingsUNTCreateDTO::fromArray($input);
                    $resultDTO = $attemptDto->toArray();
                    $setting = AttemptSettingsUnt::add($resultDTO);
                    if ($user->hasRole(RoleServices::TEACHER_ROLE_NAME)) {
                        NotificationService::createUNTNotification($setting);
                    }
                }
                return response()->json(new ResponseJSON(status: true, data: true));
            } else {
                return response()->json(new ResponseJSON(status: false, message: "Неверные данные"), 400);
            }
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }


    public function myAttemptSettings()
    {
        try {
            $user = auth()->guard('api')->user();
            if ($user->hasRole(RoleServices::TEACHER_ROLE_NAME)) {
                $attempt_settings = AttemptSetting::where(["owner_id" => $user->id])
                    ->with(["classroom_group", "locale", "owner", "subject"])
                    ->latest()
                    ->paginate(20);
                return response()->json(new ResponseJSON(status: true, data: $attempt_settings), 200);
            } else {
                return response()->json(new ResponseJSON(status: false, message: "У вас нет доступа"), 403);
            }
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function myAttemptSettingsUNT()
    {
        try {
            $user = auth()->guard('api')->user();
            if ($user->hasRole(RoleServices::TEACHER_ROLE_NAME)) {
                $attempt_settings = AttemptSettingsUnt::where(["sender_id" => $user->id])
                    ->with(["classroom_group", "locale", "sender"])
                    ->latest()
                    ->paginate(20);
                return response()->json(new ResponseJSON(status: true, data: $attempt_settings));
            } else {
                return response()->json(new ResponseJSON(status: false, message: "У вас нет доступа"), 403);
            }
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function deleteAttemptSettingsById($id)
    {
        try {
            $attempt_settings = AttemptSetting::findOrFail($id);
            $attempt_settings->delete();
            return response()->json(new ResponseJSON(status: true, data: true));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function deleteAttemptSettingsUNTById($id)
    {
        try {
            $attempt_settings = AttemptSettingsUnt::findOrFail($id);
            $attempt_settings->delete();
            return response()->json(new ResponseJSON(status: true, data: true));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function attemptById($id)
    {
        try {
            $user = auth()->guard("api")->user();
            $attempt = Attempt::where(["end_at" => null])->find($id);
            if (!$attempt) {
                return response()->json(new ResponseJSON(status: false, message: "Not Found"), 404);
            }
            if ($attempt->user_id != $user->id) {
                return response()->json(new ResponseJSON(status: false, message: "Forbidden"), 403);
            }
            if ($attempt->start_at->addMilliseconds($attempt->time) < Carbon::now()) {
                $attempt->update(["end_at" => Carbon::now()]);
                return response()->json(new ResponseJSON(status: false, message: "Время уже прошло"), 404);
            }
            if ($attempt->start_at > Carbon::now()) {
                return response()->json(new ResponseJSON(status: false, message: "Время еще не наступило"), 404);
            }
            $this->answerService->check_attempt($attempt, $user->id);
            $data = $this->attemptService->get_attempt_by_id($id);
            return response()->json(new ResponseJSON(status: true, data: $data), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function statAttemptById($id)
    {
        try {
            $user = auth()->guard("api")->user();
            $attempt = Attempt::where("end_at", "!=", null)->find($id);
            if (!$attempt) {
                return response()->json(new ResponseJSON(status: false, message: "Not Found"), 404);
            }
            if ($attempt->user_id != $user->id) {
                return response()->json(new ResponseJSON(status: false, message: "Forbidden"), 403);
            }
            $data = $this->attemptService->get_attempt_by_id($id, false);

            $attempt_subjects = AttemptSubject::where(["attempt_id" => $attempt->id])->pluck("id")->toArray();
            $attempt_questions = AttemptQuestion::whereIn("attempt_subject_id", $attempt_subjects)->get();

            return response()->json(new ResponseJSON(status: true, data: ["attempt" => $data, "attempt_questions" => $attempt_questions, "result" => $attempt]), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }


    public function answer(Request $request)
    {
        try {
            $answer_dto = AnswerDTO::fromRequest($request);
            $result = $this->answerService->check(
                user_id: auth()->guard("api")->id(),
                attempt_id: $answer_dto->attempt_id,
                attempt_subject_id: $answer_dto->attempt_subject_id,
                question_id: $answer_dto->question_id,
                attempt_type: $answer_dto->attempt_type_id, answers: $answer_dto->answers
            );
            return response()->json(new ResponseJSON(status: true, data: $result), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function answerResult(int $attempt_subject_id)
    {
        try {
            $user = auth()->guard("api")->user();
            $attempt_subject = AttemptSubject::where(["id" => $attempt_subject_id])->first();
            if (!$attempt_subject) {
                return response()->json(new ResponseJSON(status: false, message: "Not Found"), 404);
            }
            $attempt = Attempt::where(["id" => $attempt_subject->attempt_id])->first();
            if ($attempt->user_id != $user->id) {
                return response()->json(new ResponseJSON(status: false, message: "Forbidden"), 403);
            }
            $result = AttemptQuestion::where(["attempt_subject_id" => $attempt_subject_id, "is_answered" => true])->pluck("user_answer", "question_id")->toArray();
            foreach ($result as $key => $value) {
                $result[$key] = explode(",", $value);
            }
            return response()->json(new ResponseJSON(status: true, data: $result), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function userAttempts()
    {
        try {
            $user = auth()->guard("api")->user();
            foreach (Attempt::where(["user_id" => $user->id, "end_at" => null])->get() as $attempt) {
                $time = $attempt->start_at->addMilliseconds($attempt->time);
                if ($time <= Carbon::now()) {
                    $attempt->update(["end_at" => $time]);
                    $attempt->save();
                } else {
                    $attempt->update(['time_left' => $attempt->time - Carbon::now()->diffInMilliseconds($attempt->start_at)]);
                }
            }
            $result = Attempt::where(["user_id" => $user->id])->orderBy("start_at", "DESC")->with("attempt_type", "locale", "subjects")->paginate(12);
            return response()->json(new ResponseJSON(status: true, data: $result), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }


    public function userUntStat()
    {
        try {
            $user = auth()->guard("api")->user();
            $attempt_ids = Attempt::where(["user_id" => $user->id])->pluck("id", "id")->toArray();
            $attempt_count = Attempt::where(["user_id" => $user->id])->count();
            $attempt_count_unfinished = Attempt::where(["user_id" => $user->id, "end_at" => null])->count();
            $attempt_question_count = AttemptQuestion::whereHas("attempt_subject", function ($q) use ($attempt_ids) {
                $q->whereIn('attempt_id', $attempt_ids);
            })->pluck("question_id", "question_id")->count();
            $average_unt_count = Attempt::where(["user_id" => $user->id, "type_id" => QuestionService::UNT_TYPE])->avg("points");
            $stat_by_week = Attempt::where(["user_id" => $user->id,"type_id" => QuestionService::UNT_TYPE])
                ->whereBetween("end_at", [Carbon::now()->subWeek()->startOfDay(), Carbon::now()->endOfDay()])
                ->select([DB::raw('DATE(start_at) as date'), DB::raw('avg(points) as points')])
                ->groupBy('date')->pluck("points","date")->toArray();
            $data = ["attempt_count" => $attempt_count, "attempt_count_unfinished" => $attempt_count_unfinished, "attempt_question_count" => $attempt_question_count, "average" => round($average_unt_count), "stat_by_week" => $stat_by_week];
            return response()->json(new ResponseJSON(status: true, data: $data), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }


    public function finish(int $attempt_id)
    {
        try {
            $user = auth()->guard("api")->user();
            $attempt = Attempt::where(["end_at" => null, "id" => $attempt_id])->first();
            if (!$attempt) {
                return response()->json(new ResponseJSON(status: false, message: "Not Found"), 404);
            }
            if ($attempt->user_id != $user->id) {
                return response()->json(new ResponseJSON(status: false, message: "Forbidden"), 403);
            }
            $attempt->update(["end_at" => Carbon::now(), 'time_left' => $attempt->time - Carbon::now()->diffInMilliseconds($attempt->start_at)]);
            return response()->json(new ResponseJSON(status: true, data: $attempt_id), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }

    }
}
