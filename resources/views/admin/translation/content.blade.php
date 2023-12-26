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

        .preview-content img {
            width: 100%;
            max-width: 320px;
            height: auto;
            border-radius: inherit !important;
        }

        .preview-content p, .preview-content ul li, .preview-content ol li {
            white-space: pre-line!important;
        }

        .preview-content-ru p, .preview-content-ru ul li, .preview-content-ru ol li {
            white-space: pre-line!important;
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
                <form action="{{route('search-translations-content')}}" class="flex" method="post">
                    @csrf
                    <select name="subject_id" class="form-control mx-2">
                        <option selected value="0">Выберите предмет</option>
                        @foreach($data['subjects'] as $subject)
                            <option value="{{$subject->id}}">{{$subject->title}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-facebook">Поиск</button>
                </form>
                <div class="py-4"></div>
                <div class="w-full p-3">
                    <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="min-w-full text-left text-sm font-light">
                                        <thead class="border-b font-medium dark:border-neutral-500">
                                        <tr>
                                            <th scope="col" class="px-6 py-4">#</th>
                                            <th scope="col" class="px-6 py-4">Kk</th>
                                            <th scope="col" class="px-6 py-4">Ru</th>
                                            <th scope="col" class="px-6 py-4 text-right">Действие</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data['contents'] as $content)
                                            <tr class="border-b dark:border-neutral-500">
                                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{$data['contents']->firstItem() + $loop->index}}</td>
                                                <td class="whitespace-nowrap px-6 py-4">{!! \App\Helpers\StrHelper::getSubStr($content->text_kk) !!}</td>
                                                <td class="whitespace-nowrap px-6 py-4">{!! \App\Helpers\StrHelper::getSubStr($content->text_ru) !!}</td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    <div class="flex justify-end">
                                                        <div>
                                                            <livewire:sub-step-content.preview-content :content="$content"/>
                                                        </div>
                                                        <div>
                                                            <a href="{{route('sub-step-content.show', $content->sub_step->id)}}"
                                                               target="_blank"
                                                               class="flex items-center justify-center btn btn-outline-secondary btn-rounded btn-icon mx-1">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <form action="{{route('search-translations-content')}}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="subject_id"
                                                                       value="{{$content->step->subject_id}}">
                                                                <input type="hidden" name="content" value="{{$content}}">
                                                                <input type="hidden" name="page"
                                                                       value="{{$data['contents']->currentPage()}}">
                                                                <button type="submit"
                                                                        class="flex items-center justify-center btn btn-outline-secondary btn-rounded btn-icon mx-1">
                                                                    <i class="mdi mdi-google-translate"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    @if($data['contents'])
                                        <div class="m-3">
                                            {{$data['contents']->appends(request()->except('page'))->links('vendor.pagination.bootstrap-5')}}
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
