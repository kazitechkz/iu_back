@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.tutor_skill_lists')"
        :subtitle="__('table.tutor_skill_management')"
        :breadcrumbs="[__('table.tutor_skill_management')]"
        :routes="['tutor-skill.index']"
    >
        <a href="{{route("tutor-skill.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.tutor_skill_create_title')}}

        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:tutor-skill.tutor-skill-table/>
            </div>
        </div>
    </div>


@endsection
