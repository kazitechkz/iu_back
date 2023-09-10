@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.page_create_title')"
        :subtitle="__('table.page_create_subtitle')"
        :breadcrumbs="[__('table.page_management'),__('table.page_create_title')]"
        :routes="['page.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
               <livewire:page.create/>
            </div>
        </div>
    </div>


@endsection
