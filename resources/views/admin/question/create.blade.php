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
                    <div class="md:flex lg:flex justify-between my-3">
                        <x-ckeditor :input-name="'text'" :title="'Текст вопроса'"/>
                        <div class="px-2"></div>
                        <x-ckeditor :input-name="'context'" :title="'Контекст'"/>
                    </div>
                    <div class="my-3">
                        <x-button type="submit" primary label="Сохранить" />
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
@push('js')

@endpush
