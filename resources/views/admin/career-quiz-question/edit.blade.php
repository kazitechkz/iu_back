@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.career_quiz_questions_edit_title') . $careerQuizQuestion->question_ru"
        :subtitle="__('table.career_quiz_questions_edit_subtitle')"
        :breadcrumbs="[__('table.career_quiz_questions_management'),__('table.career_quiz_questions_edit_title')]"
        :routes="['career-quiz-question.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:career-quiz-question.edit :career-quiz-question="$careerQuizQuestion"/>
            </div>
        </div>
    </div>


@endsection
