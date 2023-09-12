@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.participant_rating_create_title')"
        :subtitle="__('table.participant_rating_create_subtitle')"
        :breadcrumbs="[__('table.participant_rating_management'),__('table.participant_rating_create_title')]"
        :routes="['participant-rating.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:participant-rating.create/>
            </div>
        </div>
    </div>


@endsection
