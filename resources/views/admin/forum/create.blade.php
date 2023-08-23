@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать Новый Форум'"
        :subtitle="'Управление Форумами'"
        :breadcrumbs="['Управление Форумами','Создать Форум']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:forum.create/>
            </div>
        </div>
    </div>


@endsection
