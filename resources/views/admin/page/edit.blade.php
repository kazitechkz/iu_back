@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Редактировать Страницу'"
        :subtitle="'Управление Страницами'"
        :breadcrumbs="['Управление Страницами','Редактировать Страницу']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:page.edit :page="$page"/>
            </div>
        </div>
    </div>


@endsection
