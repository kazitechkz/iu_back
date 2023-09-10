@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.faq_edit_title') . $faq->question"
        :subtitle="__('table.faq_edit_subtitle')"
        :breadcrumbs="[__('table.faq_management'),__('table.forum_edit_title')]"
        :routes="['faq.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:faq.edit :faq="$faq"/>
            </div>
        </div>
    </div>


@endsection
