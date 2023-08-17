@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Редактировать План Подписки'"
        :subtitle="'Управление Планами подписок'"
        :breadcrumbs="['Управление Планами','Редактировать План подписок']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:plan.edit :plan="$plan"></livewire:plan.edit>
            </div>
        </div>
    </div>


@endsection
