@extends('layouts.default')
@push('css')
    <style>
        .z-5000 {z-index: 5000!important;}
        #text-img img {
            width: 300px!important;
            height: 100%!important;
            border-radius: inherit!important;
        }
        #preview-img img {width: 100%; max-width: 320px; height: auto; border-radius: inherit!important;}
        #preview-img p {white-space: pre-line}
        mjx-container {text-align: left!important; display: inline!important;}
        #answers_math > li {margin: 20px 20px}
        .MJXc-display {display: inline!important; text-align: center; margin: 1em 0; padding: 0}
    </style>

@endpush
@section('content')
    <div class="col-lg-12 grid-margin stretch-card my-2">
        <div class="w-full mb-4 md:w-auto md:mb-0">
            <div
                x-data="{ open: false }"
                @keydown.window.escape="open = false"
                x-on:click.away="open = false"
                class="relative z-10 inline-block w-full text-left md:w-auto"
            >
                <div>
                <span class="rounded-md shadow-sm">
                    <button
                        x-on:click="open = !open"
                        type="button"
                        class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
                        aria-haspopup="true"
                        x-bind:aria-expanded="open"
                        aria-expanded="true"
                    >
                        @lang('Изменить категорию')
                        <svg class="w-5 h-5 ml-2 -mr-1" x-description="Heroicon name: chevron-down"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </span>
                </div>
                <div
                    x-cloak
                    x-show="open"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 z-50 w-full mt-2 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg md:w-48 ring-1 ring-black ring-opacity-5 focus:outline-none"
                >
                    <div class="bg-white rounded-md shadow-xs dark:bg-gray-700 dark:text-white">
                        <div class="py-1" role="menu" aria-orientation="vertical">
                            @foreach(\App\Models\Subject::all() as $item)
                                <a href="{{route('change-category-in-subject', ['id' => $item->id])}}"
                                   class="flex text-start items-center w-full px-4 py-2 space-x-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 dark:text-white dark:hover:bg-gray-600"
                                   role="menuitem"
                                >
                                    <span>{{$item->title}}</span>
                                </a>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ml-3 w-full mb-4 md:w-auto md:mb-0">
            <div
                x-data="{ open: false }"
                @keydown.window.escape="open = false"
                x-on:click.away="open = false"
                class="relative z-10 inline-block w-full text-left md:w-auto"
            >
                <div>
                <span class="rounded-md shadow-sm">
                    <button
                        x-on:click="open = !open"
                        type="button"
                        class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
                        aria-haspopup="true"
                        x-bind:aria-expanded="open"
                        aria-expanded="true"
                    >
                        @lang('Язык')
                        <svg class="w-5 h-5 ml-2 -mr-1" x-description="Heroicon name: chevron-down"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </span>
                </div>
                <div
                    x-cloak
                    x-show="open"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 z-50 w-full mt-2 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg md:w-48 ring-1 ring-black ring-opacity-5 focus:outline-none"
                >
                    <div class="bg-white rounded-md shadow-xs dark:bg-gray-700 dark:text-white">
                        <div class="py-1" role="menu" aria-orientation="vertical">
                            @foreach(\App\Models\Locale::all() as $item)
                                <a href="{{route('change-category-in-subject', ['id' => $questions[0]['subject_id'], 'locale_id' => $item->id])}}"
                                   class="flex text-start items-center w-full px-4 py-2 space-x-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 dark:text-white dark:hover:bg-gray-600"
                                   role="menuitem"
                                >
                                    <span>{{$item->title}}</span>
                                </a>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-layer-components.content-navbar
        :title="$questions->count() ? $questions[0]->subject->title_ru : 'Нету вопросов'"
        :subtitle="'Управление вопросами'"
    >
        <a href="{{route("questions.create")}}" class="btn btn-primary mt-2 mt-xl-0">Создать</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    @if($questions->count())
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">Категория</th>
                            <th scope="col">Вопрос</th>
{{--                            <th scope="col">Правильный ответ</th>--}}
                            <th scope="col">Действие</th>
                        </tr>
                    </thead>
                        <tbody id="mathdiv">
                            @foreach($questions as $question)
                                <tr>
                                    <th scope="row">{{$questions->firstItem() + $loop->index}}</th>
                                    <th scope="row">{{$question->id}}</th>
                                    <td>
                                        <livewire:question.change-category :question="$question"/>
                                    </td>
                                    <td>{{\App\Helpers\StrHelper::getSubStr($question->text, 250)}}</td>
{{--                                    <td>--}}
{{--                                        @foreach(explode(',', $question->correct_answers) as $ans)--}}
{{--                                            {{$loop->iteration}}. {{\App\Helpers\StrHelper::getSubStr(\App\Helpers\StrHelper::getCorrectAnswers($question, $ans), 30)}} <br>--}}
{{--                                        @endforeach--}}
{{--                                    </td>--}}
                                    <td class="flex max-w-full" >
                                        <livewire:question.preview-question :question="$question"/>
                                        <x-shared.action-buttons
                                            :edit-link="route('questions.edit', $question->id)"
                                            :delete-link="route('questions.destroy', $question->id)"
                                        />
                                        @if($question->group_id != 11)
                                            <a class="mx-2" href="{{route('move-question-to-defect', $question->id)}}">
                                                <button class="btn btn-outline-secondary btn-rounded btn-icon">
                                                    <i class="mdi mdi-information-variant"></i>
                                                </button>
                                            </a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <p>Ничего не найдено!</p>
                    @endif
                </table>

                {!! $questions->links() !!}
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script>
        MathJax = {
            loader: {
                load: ['[tex]/color','[tex]/cancel']
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
