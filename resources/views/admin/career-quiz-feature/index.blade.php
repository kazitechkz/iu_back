@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.career_quiz_features_lists')"
        :subtitle="__('table.career_quiz_features_management')"
        :breadcrumbs="[__('table.career_quiz_features_management')]"
        :routes="['career-quiz-feature.index']"
    >
        <a href="{{route("career-quiz-feature.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.career_quiz_features_create_title')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>


@endsection
