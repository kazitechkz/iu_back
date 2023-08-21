@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Редактировать Группу'"
        :subtitle="'Управление Группами'"
        :breadcrumbs="['Управление Группами','Редактировать Группу']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:group.edit :group="$group"/>
            </div>
        </div>
    </div>


@endsection
