@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.lesson_schedule_lists')"
        :subtitle="__('table.lesson_schedule_management')"
        :breadcrumbs="[__('table.lesson_schedule_management')]"
        :routes="['lesson-schedule.index']"
    >
        <a href="{{route("lesson-schedule.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.lesson_schedule_create_title')}}

        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:lesson-schedule.lesson-schedule-table/>
            </div>
        </div>
    </div>


@endsection
