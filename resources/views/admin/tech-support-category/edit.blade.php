@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.tech_support_category_edit_title')"
        :subtitle="__('table.tech_support_category_edit_subtitle')"
        :breadcrumbs="[__('table.tech_support_category_management'),__('table.tech_support_category_edit_title')]"
        :routes="['tech-support-category.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:tech-support-category.edit :tech_support_category="$techSupportCategory"/>
            </div>
        </div>
    </div>


@endsection
