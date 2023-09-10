@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.appeal_edit_title') . $appel->id"
        :subtitle="__('table.appeal_edit_subtitle')"
        :breadcrumbs="[__('table.appeal_management'),__('table.appeal_edit_title')]"
        :routes="['appeal.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:appeal.edit :appeal="$appeal"/>
            </div>
        </div>
    </div>


@endsection

