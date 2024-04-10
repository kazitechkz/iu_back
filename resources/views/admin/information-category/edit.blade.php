@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.information_category_lists')"
        :subtitle="__('table.information_category_edit_subtitle')"
        :breadcrumbs="[__('table.information_category_management'),__('table.information_category_edit_title')]"
        :routes="['information-category.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:information-category.edit :information-category="$informationCategory"/>
            </div>
        </div>
    </div>


@endsection
