@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.wallet_lists')"
        :subtitle="__('table.wallet_management')"
        :breadcrumbs="[__('table.wallet_management')]"
        :routes="['wallet.index']"
    >
{{--        <a href="{{route("wallet.create")}}" class="btn btn-primary mt-2 mt-xl-0">--}}
{{--            {{__('table.wallet_create_title')}}--}}
{{--        </a>--}}

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:cash.index-table theme="tailwind" />
{{--                <livewire:wallet.wallet-table theme="tailwind" />--}}
            </div>
        </div>
    </div>


@endsection
