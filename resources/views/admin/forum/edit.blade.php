@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.forum_edit_title') . $faq->question"
        :subtitle="__('table.forum_edit_subtitle')"
        :breadcrumbs="[__('table.forum_management'),__('table.forum_edit_title')]"
        :routes="['forum.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:forum.edit :forum="$forum"/>
            </div>
        </div>
    </div>


@endsection
