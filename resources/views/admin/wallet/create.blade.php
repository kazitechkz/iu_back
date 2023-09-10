@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.wallet_create_title')"
        :subtitle="__('table.wallet_create_subtitle')"
        :breadcrumbs="[__('table.wallet_management'),__('table.wallet_create_title')]"
        :routes="['wallet.index']"
    />

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:wallet.create></livewire:wallet.create>
            </div>
        </div>
    </div>


@endsection
