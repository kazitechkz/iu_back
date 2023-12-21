@extends('layouts.default')
@push('css')
    <style>
        .z-5000 {z-index: 5000!important;}
        .preview-content {
            white-space: pre-line;
        }
        .preview-content img {
            width: 300px!important;
            height: 100%!important;
            border-radius: inherit!important;
        }
        mjx-container {text-align: left!important; display: inline!important; white-space: pre-line}
        mjx-container > mjx-math {white-space: pre-line}
        .MJXc-display {display: inline!important; text-align: center; margin: 1em 0; padding: 0}
    </style>
@endpush
@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="my-3">
                    <form class="flex justify-between" action="{{route('filter-stats-on-user')}}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$userID}}">
                        <input type="hidden" name="is_contents" value="1">
                        <select name="subject_id" class="form-control mx-1">
                            <option value="">Выберите предмет</option>
                            @foreach($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->title}}</option>
                            @endforeach
                        </select>
                        <input type="date" class="form-control mx-1" name="date">
                        <button type="submit" class="btn bg-blue-400 text-white mx-1">Поиск</button>
                    </form>
                </div>
                <div>
                    <h1>Тесты</h1>
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="min-w-full text-left text-sm font-light">
                                        <thead class="border-b font-medium dark:border-neutral-500">
                                        <tr>
                                            <th scope="col" class="px-6 py-4">ID</th>
                                            <th scope="col" class="px-6 py-4">Предмет</th>
                                            <th scope="col" class="px-6 py-4">Текст</th>
                                            <th scope="col" class="px-6 py-4">Дата создания</th>
                                            <th scope="col" class="px-6 py-4">Действие</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($contents as $stat)
                                            @if($stat->sub_step_content)
                                                <tr class="border-b dark:border-neutral-500">
                                                    <td class="whitespace-nowrap px-6 py-4">{{$stat->sub_step_content->id}}</td>
                                                    <td class="whitespace-nowrap px-6 py-4">{{$stat->sub_step_content->step->subject->title}}</td>
                                                    <td class="whitespace-nowrap px-6 py-4">{{$stat->sub_step_content->text_kk}}</td>
                                                    <td class="whitespace-nowrap px-6 py-4">{{$stat->created_at->format('d.m.Y H:m')}}</td>
                                                    <td class="whitespace-nowrap px-6 py-4">
                                                        <livewire:sub-step-content.preview-content :content="$stat->sub_step_content" />
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
                                    @if($contents)
                                        <div class="my-3">
                                            {!! $contents->appends(request()->except('page'))->links() !!}
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
