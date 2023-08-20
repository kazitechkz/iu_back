@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список Кошельков'"
        :subtitle="'Управление кошельками пользователей'"
        :breadcrumbs="['Управление кошельками']"
    >
        <a href="{{route("wallet.create")}}" class="btn btn-primary mt-2 mt-xl-0">Add new User</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:wallet.wallet-table theme="tailwind" />
            </div>
        </div>
    </div>


@endsection
