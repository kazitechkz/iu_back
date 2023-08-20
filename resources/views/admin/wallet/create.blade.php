@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Операция с кошельком'"
        :subtitle="'Блок создания новой транзакции'"
        :breadcrumbs="['Управление пользователями','Создать новую транзакцию']"
    />

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:wallet.create></livewire:wallet.create>
            </div>
        </div>
    </div>


@endsection
