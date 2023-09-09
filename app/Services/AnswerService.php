<?php

namespace App\Services;

use App\Exceptions\AnswerException;
use App\Models\Attempt;
use App\Models\AttemptQuestion;
use App\Models\AttemptSubject;
use App\Models\Question;
use App\Models\SubTournament;
use App\Models\SubTournamentResult;
use App\Models\SubTournamentRival;
use App\Models\TournamentStep;
use Carbon\Carbon;
use Carbon\Traits\Date;
use function Symfony\Component\Translation\t;

class AnswerService
{
        public function finish_test($user_id,int $attempt_id){
            try {
                if($attempt = Attempt::where(["id"=>$attempt_id,"user_id" => $user_id,"end_at" => null])->first()){
                    $attempt->end_at = Carbon::now();
                    $attempt->save();
                    return true;
                }
                else{
                    throw new AnswerException("Попытка сдачи не найдена");
                }
            }
            catch (\Exception $exception){
                throw new AnswerException($exception->getMessage());
            }

        }


        public function check($user_id,int $attempt_id,int $attempt_subject_id,int $question_id,string $answers,$attempt_type){
            try {
                $answers = strtolower($answers);
                //Check if attempt_id exists
                if($attempt = Attempt::where(["id"=>$attempt_id,"user_id" =>$user_id,"end_at" => null])->first()){
                    //Check if attempt_question exists
                    if($attempt_question = AttemptQuestion::where(["attempt_subject_id"=>$attempt_subject_id,"question_id"=>$question_id,"is_answered" => false])->first()){
                        $result = $this->check_answer($question_id, $answers);
                        $attempt_question->update(["is_right"=>$result["is_right"],"point"=>$result["point"],"is_answered"=>true,"user_answer"=>$answers]);
                        $attempt->edit(["points"=>$attempt->points + $result["point"],'time_left'=>$attempt->start_at->diffInMilliseconds(Carbon::now())]);
                        if($attempt_type == QuestionService::TOURNAMENT_TYPE){
                            $this->check_tournament_result($attempt,$attempt_type,$user_id);
                        }
                        $this->check_attempt($attempt,$user_id);
                        return true;
                    }
                    else{
                        throw new AnswerException("Вопрос на который вы хотите ответить либо не найден, либо вы уже ответили на него");
                    }
                }
                else{
                    throw new AnswerException("Попытка сдачи экзамена не найдена");
                }
            }
            catch (\Exception $exception){
                throw new AnswerException($exception->getMessage());
            }

        }


        protected function check_answer($question_id,string $answer){
            //"a,b,c"=>["a","b","c"]
            $user_answer = array_unique(explode(",",$answer));
            if($question = Question::find($question_id)){
                $count_answer = count($user_answer);
                $point = 0;
                $is_right = false;
                if($question->type_id == QuestionService::SINGLE_QUESTION_ID || $question->type_id == QuestionService::CONTEXT_QUESTION_ID){
                    if ($count_answer == 1){
                        if(strtolower($question->correct_answers) == $user_answer[0]){
                            $point = 1;
                            $is_right = true;
                        }
                    }
                }
                elseif ($question->type_id == QuestionService::MULTI_QUESTION_ID){
                    $correct_answer = explode(",",strtolower($question->correct_answers));
                    $intersect = count(array_intersect($user_answer,$correct_answer));
                    $diff = count(array_diff($user_answer,$correct_answer));
                    if(count($correct_answer) == 1){
                        if($count_answer == 1){
                                if($intersect == 1 && $diff == 0){
                                    $point = 2;
                                    $is_right = true;
                                }
                        }
                        if($count_answer == 2){
                            if($intersect == 1 && $diff == 1){
                                $point = 1;
                                $is_right = true;
                            }
                        }
                    }
                    //Дано 2 правильных ответа
                    elseif (count($correct_answer) == 2){
                        //Дано 1 ответ
                        if($count_answer == 1){
                            if($intersect == 1){
                                $point = 1;
                                $is_right = true;
                            }
                        }
                        //Дано 2 ответа
                        elseif ($count_answer == 2){
                            if($intersect == 2 && $diff == 0){
                                $point = 2;
                                $is_right = true;
                            }
                            elseif($intersect == 1 && $diff == 1 ){
                                $point = 1;
                                $is_right = true;
                            }

                        }
                        elseif ($count_answer == 3){
                            if($intersect == 2 && $diff == 1){
                                $point = 1;
                                $is_right = true;
                            }
                        }
                    }
                    //Дано 3 ответа
                    elseif (count($correct_answer) == 3){
                        // 2 ответа
                        if ($count_answer == 2){
                            if($intersect == 2 && $diff == 0){
                                $point = 1;
                                $is_right = true;
                            }
                        }
                        // 3 ответа
                        elseif ($count_answer == 3){
                            if($intersect == 3 && $diff == 0){
                                $point = 2;
                                $is_right = true;
                            }
                            elseif ($intersect == 2 && $diff == 1){
                                $point = 1;
                                $is_right = true;
                            }
                        }
                        //4 ответа
                        elseif ($count_answer == 4){
                            if($intersect == 3 && $diff == 1){
                                $point = 1;
                                $is_right = true;
                            }
                        }
                    }

                }
                return ["is_right"=>$is_right,"point"=>$point];
            }
            else{
                throw new AnswerException("Вопрос на который вы хотите ответить либо не найден");
            }
        }


        protected function check_tournament_result(Attempt $attempt,int $attempt_type_id,$user_id){
            if($attempt_type_id == QuestionService::TOURNAMENT_TYPE){
                $sub_tournament_result = SubTournamentResult::where(["attempt_id" => $attempt->id,"user_id" => $user_id])->first();
                if($sub_tournament_result){
                    $sub_tournament_result->edit(["point"=>$attempt->points,"time"=>$attempt->time_left]);
                    $sub_tournament_rival = SubTournamentRival::
                    orWhere(function ( $query) use ($sub_tournament_result,$user_id) {
                        $query->where("sub_tournament_id" ,"=", $sub_tournament_result->sub_tournament_id)
                            ->where("rival_two" ,"=", $user_id);
                    })
                        ->orWhere(function ( $query) use ($sub_tournament_result,$user_id) {
                            $query->where("sub_tournament_id" ,"=", $sub_tournament_result->sub_tournament_id)
                                ->where("rival_one" ,"=", $user_id);
                        })
                        ->first();
                    if($sub_tournament_rival){
                        if($sub_tournament_rival->rival_one == $user_id){
                            $sub_tournament_rival->point_one = $attempt->points;
                            $sub_tournament_rival->time_one = $attempt->time_left;
                        }
                        elseif($sub_tournament_rival->rival_two == $user_id){
                            $sub_tournament_rival->point_two = $attempt->points;
                            $sub_tournament_rival->time_two = $attempt->time_left;
                        }
                        if($sub_tournament_rival->point_two > $sub_tournament_rival->point_one){
                            $sub_tournament_rival->winner = $sub_tournament_rival->rival_two;
                        }
                        elseif ($sub_tournament_rival->point_two < $sub_tournament_rival->point_one){
                            $sub_tournament_rival->winner = $sub_tournament_rival->rival_one;
                        }
                        elseif ($sub_tournament_rival->point_two == $sub_tournament_rival->point_one){
                            if($sub_tournament_rival->time_one < $sub_tournament_rival->time_two){
                                $sub_tournament_rival->winner = $sub_tournament_rival->rival_one;
                            }
                            elseif ($sub_tournament_rival->time_one > $sub_tournament_rival->time_two){
                                $sub_tournament_rival->winner = $sub_tournament_rival->rival_two;
                            }
                        }
                        $sub_tournament_rival->save();
                    }
                }
            }
        }

        protected function check_attempt(Attempt $attempt,$user_id){
            if($attempt->time < $attempt->time_left){
                $this->finish_test($user_id,$attempt->id);
                throw new AnswerException("Вышло время сдачи!");
            }
            $attempt_subjects = AttemptSubject::where(["attempt_id"=>$attempt->id])->pluck("id","id");
            $count = AttemptQuestion::whereIn("attempt_subject_id",$attempt_subjects)->where("is_answered",true)->count();
            if($attempt->max_points == $count){
                $this->finish_test($user_id,$attempt->id);
            }
        }
}
