@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.wallet_lists')"
        :subtitle="__('table.wallet_management')"
        :breadcrumbs="[__('table.wallet_management')]"
        :routes="['wallet.index']"
    >
    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:wallet.wallet-index-table theme="tailwind" />
            </div>
        </div>
    </div>

@endsection
