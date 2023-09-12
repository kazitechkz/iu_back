@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.lesson_schedule_participant_edit_title')"
        :subtitle="__('table.lesson_schedule_participant_edit_subtitle')"
        :breadcrumbs="[__('table.lesson_schedule_participant_management'),__('table.lesson_schedule_participant_edit_title')]"
        :routes="['lesson-schedule-participant.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:lesson-schedule-participant.edit :lesson_schedule_participant="$lesson_schedule_participant"/>
            </div>
        </div>
    </div>


@endsection
