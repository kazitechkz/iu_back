@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.iutube_author_edit_title') .':'. $careerQuizAuthor->name"
        :subtitle="__('table.iutube_author_edit_subtitle')"
        :breadcrumbs="[__('table.iutube_author_management'),__('table.iutube_author_edit_title')]"
        :routes="['iutube_author.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>


@endsection
