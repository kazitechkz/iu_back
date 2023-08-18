@extends('layouts.default')
@push('css')

@endpush
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать новый вопрос'"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('questions.store')}}" method="post">
                    @csrf
                    <livewire:question.create />
                    <textarea name="text"></textarea>

                    <div class="my-3">
                        <x-button type="submit" primary label="Сохранить" />
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
@push('js')
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('text', {
            filebrowserUploadUrl: "{{route('questions-ckeditor-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endpush
