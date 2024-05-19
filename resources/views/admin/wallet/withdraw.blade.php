@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Заявки'"
    >
        {{--        <a href="{{route("wallet.create")}}" class="btn btn-primary mt-2 mt-xl-0">--}}
        {{--            {{__('table.wallet_create_title')}}--}}
        {{--        </a>--}}

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:cash.withdraw-table theme="tailwind" />
                {{--                <livewire:wallet.wallet-table theme="tailwind" />--}}
            </div>
        </div>
    </div>


@endsection
