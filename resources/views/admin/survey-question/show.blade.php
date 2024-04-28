@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Блок создания опросника'"
        :breadcrumbs="['Список опросников',__('table.announcement_create_title')]"
        :routes="['survey.index']"
    />
    <div class="my-3 bg-white">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Вопрос</th>
                <th scope="col">Ответы</th>
                <th scope="col">Язык</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($questions as $question)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$question->text}}</td>
                    <td>
                        @if($question->answer_a)
                            <p>{{$question->answer_a}}</p>
                        @endif
                        @if($question->answer_b)
                            <p>{{$question->answer_b}}</p>
                        @endif
                        @if($question->answer_c)
                            <p>{{$question->answer_c}}</p>
                        @endif
                        @if($question->answer_d)
                            <p>{{$question->answer_d}}</p>
                        @endif
                        @if($question->answer_e)
                            <p>{{$question->answer_e}}</p>
                        @endif
                        @if($question->answer_f)
                            <p>{{$question->answer_f}}</p>
                        @endif
                    </td>
                    <td>{{$question->locale_id == 1 ? 'Каз' : 'Рус'}}</td>
                    <td>
                        <form action="{{route('survey-question.destroy', $question->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit"><i class="mdi mdi-trash-can text-danger"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('survey-question.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="survey_id" value="{{$survey->id}}">
                    <div class="my-2">
                        <select name="locale_id" class="form-control">
                            @foreach($locales as $locale)
                                <option value="{{$locale->id}}">{{$locale->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <textarea name="text" class="form-control my-2" placeholder="Вопрос"></textarea>
                    <input type="text" name="answer_a" class="form-control my-2" placeholder="Ответ A">
                    <input type="text" name="answer_b" class="form-control my-2" placeholder="Ответ B">
                    <input type="text" name="answer_c" class="form-control my-2" placeholder="Ответ C">
                    <input type="text" name="answer_d" class="form-control my-2" placeholder="Ответ D">
                    <input type="text" name="answer_e" class="form-control my-2" placeholder="Ответ E">
                    <input type="text" name="answer_f" class="form-control my-2" placeholder="Ответ F">
                    <input type="number" name="order" class="form-control my-2" placeholder="Порядочный номер">
                    <div class="my-2">
                        <label for="own_answer">Собственный ответ (необъязательно)</label>
                        <select name="own_answer" class="form-control" id="own_answer">
                            <option value="">Не выбрано</option>
                            <option value="answer_a">A</option>
                            <option value="answer_b">B</option>
                            <option value="answer_c">C</option>
                            <option value="answer_d">D</option>
                            <option value="answer_e">E</option>
                            <option value="answer_f">F</option>
                        </select>
                    </div>
                    <div class="my-2">
                        <input type="submit" class="btn text-white" value="Отправить" style="background-color: #2caae1"/>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
