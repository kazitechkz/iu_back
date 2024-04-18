@extends('layouts.default')
@push('css')
    <style>
        .z-5000 {
            z-index: 5000 !important;
        }

        #text-img img {
            width: 300px !important;
            height: 100% !important;
            border-radius: inherit !important;
        }

        #preview-img img {
            width: 100%;
            max-width: 320px;
            height: auto;
            border-radius: inherit !important;
        }

        #preview-img p {
            white-space: pre-line
        }

        mjx-container {
            text-align: left !important;
            display: inline !important;
        }

        #answers_math > li {
            margin: 20px 20px
        }

        .MJXc-display {
            display: inline !important;
            text-align: center;
            margin: 1em 0;
            padding: 0
        }
    </style>

@endpush
@section('content')
    <x-layer-components.content-navbar
        :title="'Блок создания переводов'"
    >
    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('search-translations')}}" class="flex" method="post">
                    @csrf
                    <select name="subject_id" class="form-control mx-2">
                        <option selected value="0">Выберите предмет</option>
                        @foreach($data['subjects'] as $subject)
                            <option value="{{$subject->id}}">{{$subject->title}}</option>
                        @endforeach
                    </select>
                    <select name="type_id" class="form-control mx-2">
                        <option selected value="0">Выберите тип</option>
                        @foreach($data['types'] as $type)
                            <option value="{{$type->id}}">{{$type->title}}</option>
                        @endforeach
                    </select>
                    <select name="group_id" class="form-control mx-2">
                        <option selected value="0">Выберите группу</option>
                        @foreach($data['groups'] as $group)
                            <option value="{{$group->id}}">{{$group->title}}</option>
                        @endforeach
                    </select>
                    <select name="locale_id" class="form-control mx-2">
                        <option selected value="1">Выберите язык</option>
                        <option value="1">Казахский</option>
                        <option value="2">Русский</option>
                    </select>
                    <button class="btn btn-facebook">Поиск</button>
                </form>
                <div class="py-4"></div>
                <div class="w-full p-3">
                    <ul>
                        @foreach($data['questions'] as $question)
                            <li class="grid grid-cols-2 gap-2 py-2">
                                <div class="flex justify-start">
                                    <span>{{$data['questions']->firstItem() + $loop->index}}.</span>
                                    <span class="mx-2">({{$question->id}})</span>
                                    <div class="flex w-full justify-between">
                                        <span>{{\App\Helpers\StrHelper::getSubStr($question->text, 30)}}</span>
                                        <span class="flex justify-start">
                                            <livewire:question.preview-question :question="$question"/>
                                            <a href="{{route('questions.edit', $question->id)}}" target="_blank"
                                               class="flex items-center justify-center btn btn-outline-secondary btn-rounded btn-icon mx-1">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            @if(!$question->translationQuestion)
                                                <form action="{{route('search-translations')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="subject_id" value="{{$question->subject_id}}">
                                                <input type="hidden" name="type_id" value="{{$question->type_id}}">
                                                <input type="hidden" name="group_id" value="{{$question->group_id}}">
                                                <input type="hidden" name="question" value="{{$question}}">
                                                <input type="hidden" name="page" value="{{$data['questions']->currentPage()}}">
                                                <button type="submit"
                                                        class="flex items-center justify-center btn btn-outline-secondary btn-rounded btn-icon mx-1"><i
                                                        class="mdi mdi-google-translate"></i></button>
                                            </form>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                @if($question->translationQuestion)
                                    <div class="flex justify-start">
                                        <span class="mx-2">({{$question->id}})</span>
                                        <div class="flex w-full justify-between">
                                            <span>{{\App\Helpers\StrHelper::getSubStr($question->translationQuestion->questionRU->text, 30)}}</span>
                                            <span class="flex justify-start">
                                            <livewire:question.preview-question :question="$question->translationQuestion->questionRU"/>
                                            <a href="{{route('questions.edit', $question->translationQuestion->questionRU->id)}}" target="_blank"
                                               class="flex items-center justify-center btn btn-outline-secondary btn-rounded btn-icon mx-1">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <form action="{{route('delete-translations')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="subject_id" value="{{$question->subject_id}}">
                                                <input type="hidden" name="type_id" value="{{$question->type_id}}">
                                                <input type="hidden" name="group_id" value="{{$question->group_id}}">
                                                <input type="hidden" name="delete_id" value="{{$question->translationQuestion->questionRU->id}}">
                                                <button type="submit" class="flex items-center justify-center btn btn-outline-danger btn-rounded btn-icon mx-1">
                                                    <i class="mdi mdi-trash-can"></i>
                                                </button>
                                            </form>
                                        </span>
                                        </div>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    @if($data['questions'])
                        <div class="m-3">
                            {{$data['questions']->appends(request()->except('page'))->links('vendor.pagination.bootstrap-5')}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script>
        MathJax = {
            loader: {
                load: ['[tex]/color', '[tex]/cancel']
            },
            tex: {
                packages: {'[+]': ['cancel', 'color']},
                inlineMath: [['$', '$'], ['\\(', '\\)']]
            },
            startup: {
                pageReady() {
                    return MathJax.startup.defaultPageReady();
                }
            }
        };
    </script>

    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

@endpush
