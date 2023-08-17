@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Управление пользователя к подписке'"
        :subtitle="'Блок управления подписками'"
        :breadcrumbs="['Управление подписками','Изменить пользователя к подписке']"
    />

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:subscription.edit :subscription="$subscription"/>
            </div>
        </div>
    </div>


@endsection
