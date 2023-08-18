@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать FAQ'"
        :subtitle="'Управление FAQ'"
        :breadcrumbs="['Управление FAQ','Создать FAQ']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:faq.create/>
            </div>
        </div>
    </div>


@endsection
