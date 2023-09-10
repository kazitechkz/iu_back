@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.user_edit_title') . $user->name"
        :subtitle="__('table.user_edit_subtitle')"
        :breadcrumbs="[__('table.user_management'),__('table.user_edit_title')]"
        :routes="['user.index']"
    />

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:user.edit :user="$user"></livewire:user.edit>
            </div>
        </div>
    </div>


@endsection
