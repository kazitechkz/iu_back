@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.lesson_schedule_participant_lists')"
        :subtitle="__('table.lesson_schedule_participant_management')"
        :breadcrumbs="[__('table.lesson_schedule_participant_management')]"
        :routes="['lesson-schedule-participant.index']"
    >
        <a href="{{route("lesson-schedule-participant.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.lesson_schedule_participant_create_title')}}

        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:lesson-schedule-participant.lesson-schedule-participant-table/>
            </div>
        </div>
    </div>


@endsection
