@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.group_create_title')"
        :subtitle="__('table.group_create_subtitle')"
        :breadcrumbs="[__('table.group_management'),__('table.group_create_title')]"
        :routes="['group.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:group.create/>
            </div>
        </div>
    </div>


@endsection
