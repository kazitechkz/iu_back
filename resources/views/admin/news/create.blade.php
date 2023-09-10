@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.news_create_title')"
        :subtitle="__('table.news_create_subtitle')"
        :breadcrumbs="[__('table.news_management'),__('table.news_create_title')]"
        :routes="['news.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:news.create></livewire:news.create>
            </div>
        </div>
    </div>


@endsection
