@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.appeal_type_create_title')"
        :subtitle="__('table.appeal_type_create_subtitle')"
        :breadcrumbs="[__('table.appeal_type_management'),__('table.appeal_type_create_title')]"
        :routes="['appeal-type.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:appeal-type.create/>
            </div>
        </div>
    </div>


@endsection
