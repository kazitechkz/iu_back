@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.lesson_rating_lists')"
        :subtitle="__('table.lesson_rating_management')"
        :breadcrumbs="[__('table.lesson_rating_management')]"
        :routes="['lesson-schedule.index']"
    >
        <a href="{{route("lesson-rating.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.lesson_rating_create_title')}}

        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:lesson-rating.lesson-rating-table/>
            </div>
        </div>
    </div>


@endsection
