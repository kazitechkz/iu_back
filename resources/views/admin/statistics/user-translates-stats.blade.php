@extends('layouts.default')
@push('css')
    <style>
        .pie-chart {
            height: 400px;
            margin: 0 auto;
        }
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

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {{--                <div class="row py-4 my-2">--}}
                {{--                    <div id="chartUsers" class="pie-chart"></div>--}}
                {{--                </div>--}}
                <div>
                    <h1>Переводы</h1>
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="min-w-full text-left text-sm font-light">
                                        <thead class="border-b font-medium dark:border-neutral-500">
                                        <tr>
                                            <th scope="col" class="px-6 py-4">ID</th>
                                            <th scope="col" class="px-6 py-4">Предмет</th>
                                            <th scope="col" class="px-6 py-4">Вопрос</th>
                                            <th scope="col" class="px-6 py-4">Дата создания</th>
                                            <th scope="col" class="px-6 py-4">Действие</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($translates as $stat)
                                            @if($stat->question)
                                                <tr class="border-b dark:border-neutral-500">
                                                    <td class="whitespace-nowrap px-6 py-4">{{$stat->question->id}}</td>
                                                    <td class="whitespace-nowrap px-6 py-4">{{$stat->question->subject->title_kk}}</td>
                                                    <td class="whitespace-nowrap px-6 py-4">{{$stat->question->text}}</td>
                                                    <td class="whitespace-nowrap px-6 py-4">{{$stat->created_at->format('d.m.Y H:m')}}</td>
                                                    <td class="whitespace-nowrap px-6 py-4">
                                                        <livewire:question.preview-question :question="$stat->question" :question_ru="$stat->question->translationQuestionRU->questionKK"/>
                                                    </td>
                                                </tr>
                                            @else
                                                <tr class="border-b dark:border-neutral-500">
                                                    <td class="whitespace-nowrap px-6 py-4">Ничего не найдено</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                    @if($translates)
                                        <div class="my-3">
                                            {!! $translates->links() !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
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
    {{--    <script src="https://www.google.com/jsapi"></script>--}}
    {{--    <script type="text/javascript">--}}
    {{--        let dataForUser = @json($usersData);--}}
    {{--        window.onload = function() {--}}
    {{--            google.load("visualization", "1.1", {--}}
    {{--                packages: ["corechart"],--}}
    {{--                callback: 'drawChart',--}}
    {{--                language: 'ru'--}}
    {{--            });--}}
    {{--        };--}}

    {{--        function drawChart() {--}}
    {{--            let userData = new google.visualization.DataTable()--}}
    {{--            userData.addColumn('string', 'Name');--}}
    {{--            userData.addColumn('number', 'Count');--}}
    {{--            userData.addRows(userData);--}}

    {{--            let userOptions = {--}}
    {{--                    // pieHole: 0.4,--}}
    {{--                    title: 'Распределение методистов по количеству забитых вопросов',--}}
    {{--                    is3D: true,--}}
    {{--                    sliceVisibilityThreshold: 0.02,--}}
    {{--                    slices: {--}}
    {{--                        0: { offset: 0.1 },--}}
    {{--                        1: { offset: 0.3 },--}}
    {{--                        2: { offset: 0.3 },--}}
    {{--                        3: { offset: 0.2 }--}}
    {{--                    }--}}
    {{--                }--}}
    {{--            let chartUsers = new google.visualization.PieChart(document.getElementById('chartUsers'))--}}
    {{--            chartUsers.draw(userData, userOptions);--}}
    {{--        }--}}
    {{--    </script>--}}
@endpush
