@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.information_author_lists')"
        :subtitle="__('table.information_author_create_subtitle')"
        :breadcrumbs="[__('table.information_author_management'),__('table.information_author_create_title')]"
        :routes="['information-author.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:information-author.create/>
            </div>
        </div>
    </div>


@endsection
