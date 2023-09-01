<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AttemptService;
use App\Services\QuestionService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    private QuestionService $_questionService;
    private AttemptService $_attemptService;
    public function __construct(QuestionService $questionService,AttemptService $attemptService)
    {
        $this->_questionService = $questionService;
        $this->_attemptService = $attemptService;
    }


    public function test(){

        $questions = $this->_questionService->get_questions_with_subjects([5,6,],1);
        $points = $this->_questionService->get_questions_max_point($questions);
        $attempt = $this->_attemptService->create_attempt(type_id: 2,locale_id: 1,max_points:$points,questions: $questions,time: 240 );
        dd($attempt);

    }

    public function importDb()
    {
        //    ini_set('max_execution_time', 180);
//    DB::table('questions_old')->orderBy('id')->chunk(100, function ($questions){
//        foreach ($questions as $data) {
//            $context = \App\Models\SubjectContext::firstOrCreate(['context' => $data->context, 'subject_id' => $data->subject_id]);
//        \App\Models\Question::create(
//            [
//                'text' => $data->text,
//                'context_id' => $context->id,
//                'answer_a' => $data->answer_a,
//                'answer_b' => $data->answer_b,
//                'answer_c' => $data->answer_c,
//                'answer_d' => $data->answer_d,
//                'answer_e' => $data->answer_e,
//                'answer_f' => $data->answer_f,
//                'answer_g' => $data->answer_g,
//                'answer_h' => $data->answer_h,
//                'correct_answers' => $data->correct_answers,
//                'prompt' => $data->prompt,
//                'explanation' => $data->explanation,
//                'locale_id' => $data->locale_id == 1 ? 2 : 1,
//                'subject_id' => $data->subject_id,
//                'type_id' => $data->type_id,
//                'group_id' => 3,
//                'created_at' => $data->created_at,
//                'updated_at' => $data->updated_at
//            ]);
//        }
//    });
//    $tt = \App\Models\SubjectContext::all();
//    file_put_contents('subject_context.json', json_encode($tt));
//    $questions = \App\Models\Question::all();
//    file_put_contents('questions.json', json_encode($questions));
//    dd('ok');
    }
}
