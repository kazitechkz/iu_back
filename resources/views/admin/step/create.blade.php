@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать Этап'"
        :subtitle="'Управление Этапами'"
        :breadcrumbs="['Управление Этапами','Создать Этап']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:step.create/>
            </div>
        </div>
    </div>


@endsection
