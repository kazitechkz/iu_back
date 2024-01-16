@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.career_quiz_features_create_title')"
        :subtitle="__('table.career_quiz_features_create_subtitle')"
        :breadcrumbs="[__('table.career_quiz_features_management'),__('table.career_quiz_features_create_title')]"
        :routes="['career-quiz-feature.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>


@endsection
