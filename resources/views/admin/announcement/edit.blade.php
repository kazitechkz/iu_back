@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.announcement_edit_title')"
        :subtitle="__('table.announcement_edit_subtitle')"
        :breadcrumbs="[__('table.announcement_management'),__('table.announcement_edit_title')]"
        :routes="['announcement.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:announcement.edit :announcement="$announcement"/>
            </div>
        </div>
    </div>


@endsection
