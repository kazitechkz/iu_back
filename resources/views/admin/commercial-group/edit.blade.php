@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.commercial_edit_title') . $commercial_group->title_ru"
        :subtitle="__('table.commercial_edit_subtitle')"
        :breadcrumbs="[__('table.commercial_management'),__('table.commercial_edit_title')]"
        :routes="['commercial-group.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:commercial-group.edit :commercial_group="$commercial_group"/>
            </div>
        </div>
    </div>


@endsection
