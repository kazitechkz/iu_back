@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.career_quiz_questions_lists')"
        :subtitle="__('table.career_quiz_questions_management')"
        :breadcrumbs="[__('table.career_quiz_questions_management')]"
        :routes="['career-quiz-question.index']"
    >
        <a href="{{route("career-quiz-question.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.career_quiz_questions_create_title')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:career-quiz-question.career-quiz-question-table/>
            </div>
        </div>
    </div>


@endsection
