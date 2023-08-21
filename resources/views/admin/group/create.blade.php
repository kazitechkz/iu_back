@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать Группу'"
        :subtitle="'Управление группами'"
        :breadcrumbs="['Управление Группами','Создать Группу']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:group.create/>
            </div>
        </div>
    </div>


@endsection
