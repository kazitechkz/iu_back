@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.lesson_complaint_lists')"
        :subtitle="__('table.lesson_complaint_management')"
        :breadcrumbs="[__('table.lesson_complaint_management')]"
        :routes="['lesson-schedule.index']"
    >
        <a href="{{route("lesson-complaint.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.lesson_complaint_create_title')}}

        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:lesson-complaint.lesson-complaint-table/>
            </div>
        </div>
    </div>


@endsection
