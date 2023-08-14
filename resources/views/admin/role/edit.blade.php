@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Изменить Роль '"
        :subtitle="'Управление Ролями'"
        :breadcrumbs="['Управление Ролями','Изменить роль']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:role.edit :role="$role"></livewire:role.edit>
            </div>
        </div>
    </div>


@endsection
