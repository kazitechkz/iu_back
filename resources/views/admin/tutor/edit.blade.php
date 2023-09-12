@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.tutor_edit_title')"
        :subtitle="__('table.tutor_edit_subtitle')"
        :breadcrumbs="[__('table.tutor_management'),__('table.tutor_edit_title')]"
        :routes="['tutor.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:tutor.edit :tutor="$tutor"/>
            </div>
        </div>
    </div>


@endsection
