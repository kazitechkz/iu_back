@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Редактировать Форум'"
        :subtitle="'Управление Форумами'"
        :breadcrumbs="['Управление Форумами','Редактировать Форум']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:forum.edit :forum="$forum"/>
            </div>
        </div>
    </div>


@endsection
