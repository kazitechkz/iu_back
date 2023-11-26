@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.tech_support_type_create_title')"
        :subtitle="__('table.tech_support_type_create_subtitle')"
        :breadcrumbs="[__('table.tech_support_type_management'),__('table.tech_support_type_create_title')]"
        :routes="['tech-support-type.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:tech-support-type.create/>
            </div>
        </div>
    </div>


@endsection
