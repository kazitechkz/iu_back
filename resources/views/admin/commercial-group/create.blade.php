@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.commercial_create_title')"
        :subtitle="__('table.commercial_create_subtitle')"
        :breadcrumbs="[__('table.commercial_management'),__('table.commercial_create_title')]"
        :routes="['commercial-group.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:commercial-group.create/>
            </div>
        </div>
    </div>


@endsection
