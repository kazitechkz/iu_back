@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Группа пользователей'"
        :subtitle="__('table.user_management')"
        :breadcrumbs="[__('table.user_management')]"
        :routes="['user.index']"
    >
        <a href="{{route("hubs.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            Создать группу
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:hub.index-table theme="tailwind" />
            </div>
        </div>
    </div>


@endsection
