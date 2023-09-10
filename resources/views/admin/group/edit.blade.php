@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.group_edit_title') . $group->question"
        :subtitle="__('table.group_edit_subtitle')"
        :breadcrumbs="[__('table.group_management'),__('table.group_edit_title')]"
        :routes="['group.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:group.edit :group="$group"/>
            </div>
        </div>
    </div>


@endsection
