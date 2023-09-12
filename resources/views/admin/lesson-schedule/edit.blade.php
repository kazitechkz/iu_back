@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.lesson_schedule_edit_title')"
        :subtitle="__('table.lesson_schedule_edit_subtitle')"
        :breadcrumbs="[__('table.lesson_schedule_management'),__('table.lesson_schedule_edit_title')]"
        :routes="['lesson-schedule.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:lesson-schedule.edit :lesson_schedule="$lesson_schedule"/>
            </div>
        </div>
    </div>


@endsection
