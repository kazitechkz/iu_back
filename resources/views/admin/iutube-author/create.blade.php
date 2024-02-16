@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.iutube_author_lists')"
        :subtitle="__('table.iutube_author_create_subtitle')"
        :breadcrumbs="[__('table.iutube_author_management'),__('table.iutube_author_create_title')]"
        :routes="['iutube-author.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>


@endsection
