@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.career_quiz_answers_edit_title') . $careerQuizAnswer->title_ru"
        :subtitle="__('table.career_quiz_answers_edit_subtitle')"
        :breadcrumbs="[__('table.career_quiz_answers_management'),__('table.career_quiz_answers_edit_title')]"
        :routes="['career-quiz-answer.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:career-quiz-answer.edit :career-quiz-answer="$careerQuizAnswer"/>
            </div>
        </div>
    </div>


@endsection
