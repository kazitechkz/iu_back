@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.announcement_group_edit_title')"
        :subtitle="__('table.announcement_group_edit_subtitle')"
        :breadcrumbs="[__('table.announcement_group_management'),__('table.announcement_group_edit_title')]"
        :routes="['announcement-group.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:announcement-group.edit :announcement_group="$announcement_group"/>
            </div>
        </div>
    </div>


@endsection
