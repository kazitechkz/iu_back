@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.tech_support_type_edit_title')"
        :subtitle="__('table.tech_support_type_edit_subtitle')"
        :breadcrumbs="[__('table.tech_support_type_management'),__('table.tech_support_type_edit_title')]"
        :routes="['tech-support-type.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:tech-support-type.edit :tech_support_type="$techSupportType"/>
            </div>
        </div>
    </div>


@endsection
