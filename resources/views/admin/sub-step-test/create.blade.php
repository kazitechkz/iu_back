@extends('layouts.default')
@push('css')
    <style>
        #context-img img {
            width: 200px!important;
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
    <x-layer-components.content-navbar
        :title="'Создать тест'"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
{{--                <form action="{{route('sub-step-test.store')}}" method="post">--}}
{{--                    @csrf--}}
                    <livewire:sub-step-test.sub-step-test-create />
{{--                    <div class="my-3">--}}
{{--                        <x-button type="submit" primary label="Сохранить" />--}}
{{--                    </div>--}}
{{--                </form>--}}

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
