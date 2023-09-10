@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.news_edit_title') . $news->title"
        :subtitle="__('table.news_edit_subtitle')"
        :breadcrumbs="[__('table.news_management'),__('table.news_edit_title')]"
        :routes="['news.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:news.edit :news="$news"></livewire:news.edit>
            </div>
        </div>
    </div>


@endsection
