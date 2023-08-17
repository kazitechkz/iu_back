@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Добавить пользователя к подписке'"
        :subtitle="'Блок управления подписками'"
        :breadcrumbs="['Управление подписками','Добавить пользователя к подписке']"
    />

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:subscription.create/>
            </div>
        </div>
    </div>


@endsection
