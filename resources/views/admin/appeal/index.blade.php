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
        :title="__('table.appeal_lists')"
        :subtitle="__('table.appeal_management')"
        :breadcrumbs="[__('table.appeal_management')]"
        :routes="['appeal.index']"
    >
        <a href="{{route("appeal.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.appeal_create_title')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('search-appeal')}}" class="flex" method="post">
                    @csrf
                    <div class="w-full mx-2">
                        <label for="subject_id">Выбрать предмет</label>
                        <select id="subject_id" name="subject_id" class="form-control">
                            <option selected value="0">Все</option>
                            @foreach($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->title_ru}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full mx-2">
                        <label for="type_id">Выбрать тип ошибки</label>
                        <select id="type_id" name="type_id" class="form-control">
                            <option selected value="0">Все</option>
                            @foreach($types as $type)
                                <option value="{{$type->id}}">{{$type->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full mx-2">
                        <label for="status">Выбрать статус</label>
                        <select id="status" name="status" class="form-control">
                            <option selected value="all">Все</option>
                            <option value="1">Решенные</option>
                            <option value="0">Не решенные</option>
                        </select>
                    </div>
                    <button class="btn btn-facebook">Поиск</button>
                </form>
            </div>
        </div>
    </div>
    <div class="py-4"></div>
    <div class="w-full p-3 card">
        <table class="table-auto w-full min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th scope="col" class="px-6 py-4">#</th>
                    <th scope="col" class="px-6 py-4">Сообщение</th>
                    <th scope="col" class="px-6 py-4">Тип</th>
                    <th scope="col" class="px-6 py-4">Предмет</th>
                    <th scope="col" class="px-6 py-4">Статус</th>
                    <th scope="col" class="px-6 py-4">Действие</th>
                </tr>
            </thead>
            <tbody>
            @foreach($appeals as $appeal)
                <tr class="border-b dark:border-neutral-500">
                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{$appeals->firstItem() + $loop->index}}</td>
                    <td class="whitespace-nowrap px-6 py-4">{!! $appeal->message != '' ? $appeal->message : '<span class="text-red-500">--</span>' !!}</td>
                    <td class="whitespace-nowrap px-6 py-4">{{$appeal->appeal_type->title}}</td>
                    <td class="whitespace-nowrap px-6 py-4">{{$appeal->question ? $appeal->question->subject->title : ''}}</td>
                    <td class="whitespace-nowrap px-6 py-4">{!! $appeal->status ? '<span class="text-green-500">Решен</span>' : '<span class="text-red-500">Не решен</span>' !!}</td>
                    <td class="whitespace-nowrap px-6 py-4">
                        <div class="flex w-full justify-between">
                                <span class="flex justify-start">
                                    @if($appeal->question)
                                        <livewire:question.preview-question :question="$appeal->question"/>
                                        <a href="{{route('questions.edit', $appeal->question_id)}}" target="_blank"
                                           class="flex items-center justify-center btn btn-outline-secondary btn-rounded btn-icon mx-1">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                    @endif
                                    @if($appeal->status)
                                        <a href="{{route('appeal.show', $appeal->id)}}"
                                           class="flex items-center justify-center btn btn-outline-secondary btn-rounded btn-icon mx-1">
                                            <i class="mdi mdi-cancel"></i>
                                        </a>
                                    @else
                                        <a href="{{route('appeal.show', $appeal->id)}}"
                                           class="flex items-center justify-center btn btn-outline-secondary btn-rounded btn-icon mx-1">
                                            <i class="mdi mdi-check"></i>
                                        </a>
                                    @endif
                                    <form action="{{route('appeal.destroy', $appeal->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                           class="flex items-center justify-center btn btn-outline-secondary btn-rounded btn-icon mx-1">
                                            <i class="mdi mdi-trash-can"></i>
                                        </button>
                                    </form>
                            </span>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if($appeals)
            <div class="m-3">
                {{$appeals->appends(request()->except('page'))->links('vendor.pagination.bootstrap-5')}}
            </div>
        @endif
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
