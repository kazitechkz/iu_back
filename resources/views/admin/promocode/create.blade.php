@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать Промокод'"
        :subtitle="'Управление Промокодами'"
        :breadcrumbs="['Управление Промокодами','Создать промокод']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:promocode.create/>
            </div>
        </div>
    </div>


@endsection
