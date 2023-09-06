@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать Этап'"
        :subtitle="'Управление Этапами'"
        :breadcrumbs="['Управление Этапами','Изменить Этап']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-step.edit :sub_step="$sub_step"/>
            </div>
        </div>
    </div>


@endsection
