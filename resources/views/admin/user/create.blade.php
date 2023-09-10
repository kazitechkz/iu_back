@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.user_create_title')"
        :subtitle="__('table.user_create_subtitle')"
        :breadcrumbs="[__('table.user_management'),__('table.user_create_title')]"
        :routes="['user.index']"
    />

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:user.create></livewire:user.create>
            </div>
        </div>
    </div>


@endsection
