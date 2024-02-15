@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Редактирование группы' . $hub->title_ru"
        :subtitle="''"
    />

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:hub.edit :hub="$hub"></livewire:hub.edit>
            </div>
        </div>
    </div>


@endsection
