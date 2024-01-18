@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.career_quiz_groups_edit_title') . $careerQuizGroup->title_ru"
        :subtitle="__('table.career_quiz_groups_edit_subtitle')"
        :breadcrumbs="[__('table.career_quiz_groups_management'),__('table.career_quiz_groups_edit_title')]"
        :routes="['career-quiz-group.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:career-quiz-group.edit :career-quiz-group="$careerQuizGroup"/>
            </div>
        </div>
    </div>


@endsection
