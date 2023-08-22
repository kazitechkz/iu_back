@extends('layouts.default')
@push('css')

@endpush
@section('content')
    <x-layer-components.content-navbar
        :title="'Редактировать новый вопрос'"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('questions.update', $question->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <livewire:question.edit :question="$question" />
                    <div class="my-3">
                        <x-button type="submit" primary label="Обновить" />
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
@push('js')

@endpush
