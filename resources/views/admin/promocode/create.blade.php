@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.promocode_create_title')"
        :subtitle="__('table.promocode_create_subtitle')"
        :breadcrumbs="[__('table.promocode_management'),__('table.promocode_create_title')]"
        :routes="['promocode.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:promocode.create/>
            </div>
        </div>
    </div>


@endsection
