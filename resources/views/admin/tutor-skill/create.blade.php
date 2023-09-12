@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.tutor_skill_create_title')"
        :subtitle="__('table.tutor_skill_create_subtitle')"
        :breadcrumbs="[__('table.tutor_skill_management'),__('table.tutor_skill_create_title')]"
        :routes="['tutor-skill.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:tutor-skill.create/>
            </div>
        </div>
    </div>


@endsection
