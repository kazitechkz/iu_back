@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать Страницу'"
        :subtitle="'Управление Страницами'"
        :breadcrumbs="['Управление Страницами','Создать Страницы']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
               <livewire:page.create/>
            </div>
        </div>
    </div>


@endsection
