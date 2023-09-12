@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.gender_edit_title')"
        :subtitle="__('table.gender_edit_subtitle')"
        :breadcrumbs="[__('table.gender_management'),__('table.gender_edit_title')]"
        :routes="['gender.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:gender.edit :gender="$gender"/>
            </div>
        </div>
    </div>


@endsection
