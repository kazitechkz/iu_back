@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.career_quiz_groups_lists')"
        :subtitle="__('table.career_quiz_groups_management')"
        :breadcrumbs="[__('table.career_quiz_groups_management')]"
        :routes="['career-quiz-group.index']"
    >
        <a href="{{route("career-quiz-group.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.career_quiz_groups_create_title')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>


@endsection
