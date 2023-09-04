<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\SubjectContext;
use App\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function importDb()
    {
        ini_set('memory_limit', "8192M");
        ini_set('max_execution_time', 3000);
//        DB::table('questions_old')->orderBy('id')->chunk(100, function ($questions) {
//            foreach ($questions as $data) {
//                $context = SubjectContext::firstOrCreate(['context' => $data->context, 'subject_id' => $data->subject_id]);
//                Question::create(
//                    [
//                        'id' => $data->id,
//                        'text' => $data->text,
//                        'context_id' => $context->id,
//                        'answer_a' => $data->answer_a,
//                        'answer_b' => $data->answer_b,
//                        'answer_c' => $data->answer_c,
//                        'answer_d' => $data->answer_d,
//                        'answer_e' => $data->answer_e,
//                        'answer_f' => $data->answer_f,
//                        'answer_g' => $data->answer_g,
//                        'answer_h' => $data->answer_h,
//                        'correct_answers' => $data->correct_answers,
//                        'prompt' => $data->prompt,
//                        'explanation' => $data->explanation,
//                        'locale_id' => $data->locale_id == 1 ? 2 : 1,
//                        'subject_id' => $data->subject_id,
//                        'type_id' => $data->type_id,
//                        'group_id' => 1,
//                        'created_at' => $data->created_at,
//                        'updated_at' => $data->updated_at
//                    ]);
//            }
//        });
//        $data = [];
//        $users = DB::table('users_old')->whereNotNull('email')->get();
//        foreach ($users as $user) {
//            if ($this->getReturnEmail($user->email, $user->phone)) {
//                $data[] = $user;
//            }
//        }
//        dd($data);
//        foreach ($data as $user) {
//            $phoneExists = \App\Models\User::where('phone', $user->phone)->first();
//            if (!$phoneExists) {
//                \App\Models\User::create([
//                    'email' => $user->email,
//                    'name' => $user->name,
//                    'username' => $user->name,
//                    'phone' => $user->phone,
//                    'password' => bcrypt('123456')
//                ]);
//            }
//        }

//    $tt = \App\Models\SubjectContext::all();
//    file_put_contents('subject_context.json', json_encode($tt));
//    $questions = \App\Models\Question::all();
//    file_put_contents('questions.json', json_encode($questions));
//    $users = \App\Models\User::all();
//    file_put_contents('users.json', json_encode($users));
    dd('done');
    }

    public function getReturnEmail($email, $phone)
    {
        $justEmails = preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email);
        $justNums = preg_replace("/[^0-9]/", '', $phone);
        if ($justEmails && strlen($justNums) > 10 && strlen($justNums) <= 11) {
            return true;
        } else {
            return false;
        }
    }
}
