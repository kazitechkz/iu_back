@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.iutube_access_edit_title') .':'. $access->subject->title_ru"
        :subtitle="__('table.iutube_access_edit_subtitle')"
        :breadcrumbs="[__('table.iutube_access_management'),__('table.iutube_access_edit_title')]"
        :routes="['iutube-access.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:i-u-tube-access.edit :access="$access"/>
            </div>
        </div>
    </div>


@endsection
