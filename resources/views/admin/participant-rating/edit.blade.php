@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.participate_rating_edit_title')"
        :subtitle="__('table.participate_rating_edit_subtitle')"
        :breadcrumbs="[__('table.participate_rating_management'),__('table.participate_rating_edit_title')]"
        :routes="['lesson-schedule.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:participant-rating.edit :participate_rating="$participate_rating"/>
            </div>
        </div>
    </div>


@endsection
