@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.locale_edit_title') . $locale->title"
        :subtitle="__('table.locale_edit_subtitle')"
        :breadcrumbs="[__('table.locale_management'),__('table.locale_edit_title')]"
        :routes="['locale.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:locale.edit :locale="$locale"/>
            </div>
        </div>
    </div>


@endsection
