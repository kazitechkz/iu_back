<?php

namespace App\Services;

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

class AnswerService
{
        public function finishTest($user_id,int $attempt_id){
            if($attempt = Attempt::where(["id"=>$attempt_id,"user_id" => $user_id,"end_at" => null])->first()){
                $attempt->end_at = Carbon::now();
                $attempt->save();
                return true;
            }
            else{
                return throw new \Exception("Attempt not found");
            }
        }


        public function check($user_id,int $attempt_id,int $attempt_subject_id,int $question_id,string $answers,$type_id){
            $answers = strtolower($answers);
            //Check if attempt_id exists
            if($attempt = Attempt::where(["id"=>$attempt_id,"user_id" =>$user_id])->first()){
                if($attempt->end_at != null){
                    return throw new \Exception("Attempts is finished");
                }
                //Check if attempt_question exists
                if($attempt_question = AttemptQuestion::where(["attempt_subject_id"=>$attempt_subject_id,"question_id"=>$question_id])->first()){
                    if($attempt_question->is_answered){
                       return throw new \Exception("Question has been answered");
                    }
                    else{
                        $result = $this->checkAnswer($question_id, $answers);
                        $attempt_question->update(["is_right"=>$result["is_right"],"point"=>$result["point"],"is_answered"=>true,"user_answer"=>$answers]);
                        $attempt->points = $attempt->points + $result["point"];
                        $attempt->save();
                        if($type_id == QuestionService::TOURNAMENT_TYPE){
                            $sub_tournament_result = SubTournamentResult::where(["attempt_id" => $attempt_id,"user_id" => $user_id,])->first();
                            if($sub_tournament_result){
                                $sub_tournament_result->edit(["point"=>$attempt->points,"time"=>$attempt->time]);
                                $query = SubTournamentRival::where(["sub_tournament_id" => $sub_tournament_result->sub_tournament_id]);
                                $sub_tournament_rival = $query->where(["rival_one"=>$user_id])->first() ?? $query->where(["rival_two"=>$user_id])->first();
                                if($sub_tournament_rival){
                                    if($sub_tournament_rival->rival_one == $user_id){
                                        $sub_tournament_rival->point_one = $attempt->points;
                                        $sub_tournament_rival->time_one = $attempt->time;
                                    }
                                    elseif($sub_tournament_rival->rival_two == $user_id){
                                        $sub_tournament_rival->point_two = $attempt->points;
                                        $sub_tournament_rival->time_two = $attempt->time;
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
                        return true;
                    }
                }
                else{
                    return throw new \Exception("Attempts doesnt exist");
                }
            }
            else{
                return throw new \Exception("Attempts doesnt exist");
            }
        }


        protected function checkAnswer($question_id,string $answer){
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
                throw new \Exception("Question Doesnt exists");
            }





        }


}
