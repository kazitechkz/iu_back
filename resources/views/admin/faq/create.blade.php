@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.faq_create_title')"
        :subtitle="__('table.faq_create_subtitle')"
        :breadcrumbs="[__('table.faq_management'),__('table.faq_create_title')]"
        :routes="['faq.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:faq.create/>
            </div>
        </div>
    </div>


@endsection
