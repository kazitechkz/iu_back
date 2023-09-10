@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.appeal_type_edit_title') . $appeal_type->id"
        :subtitle="__('table.appeal_type_edit_subtitle')"
        :breadcrumbs="[__('table.appeal_type_management'),__('table.appeal_type_edit_title')]"
        :routes="['appeal-type.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:appeal-type.edit :appeal-type="$appeal_type"/>
            </div>
        </div>
    </div>


@endsection
