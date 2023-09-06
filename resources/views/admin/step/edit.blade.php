@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Изменить Этап'"
        :subtitle="'Управление Этапами'"
        :breadcrumbs="['Управление Этапами','Изменить Этап']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:step.edit :step="$step"/>
            </div>
        </div>
    </div>


@endsection
