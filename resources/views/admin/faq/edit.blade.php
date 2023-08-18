@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Редактировать FAQ'"
        :subtitle="'Управление FAQ'"
        :breadcrumbs="['Управление FAQ','Редактировать FAQ']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:faq.edit :faq="$faq"/>
            </div>
        </div>
    </div>


@endsection
