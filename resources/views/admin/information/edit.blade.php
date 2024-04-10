@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.information_lists')"
        :subtitle="__('table.information_edit_subtitle')"
        :breadcrumbs="[__('table.information_management'),__('table.information_edit_title')]"
        :routes="['information-author.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:information.edit :information="$information"/>
            </div>
        </div>
    </div>


@endsection
