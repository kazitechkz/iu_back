@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Редактировать Локализации План Подписки'"
        :subtitle="'Управление Локализации Планами подписок'"
        :breadcrumbs="['Управление Планами','Редактировать Локализации План подписок']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:plan-combination.edit :plan-combination="$plan_combination"></livewire:plan-combination.edit>
            </div>
        </div>
    </div>


@endsection
