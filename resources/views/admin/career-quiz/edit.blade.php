@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.career_quizzes_edit_title') . $careerQuiz->title_ru"
        :subtitle="__('table.career_quizzes_edit_subtitle')"
        :breadcrumbs="[__('table.career_quizzes_management'),__('table.career_quizzes_edit_title')]"
        :routes="['career-quiz.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:career-quiz.edit :career-quiz="$careerQuiz"/>
            </div>
        </div>
    </div>


@endsection
