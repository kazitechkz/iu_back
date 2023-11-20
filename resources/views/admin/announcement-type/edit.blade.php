@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.announcement_type_edit_title')"
        :subtitle="__('table.announcement_type_edit_subtitle')"
        :breadcrumbs="[__('table.announcement_type_management'),__('table.announcement_type_edit_title')]"
        :routes="['announcement-type.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:announcement-type.edit :announcement_type="$announcement_type"/>
            </div>
        </div>
    </div>


@endsection
