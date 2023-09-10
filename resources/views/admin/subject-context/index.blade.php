@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.subject_context_lists')"
        :subtitle="__('table.subject_context_management')"
        :breadcrumbs="[__('table.subject_context_management')]"
        :routes="['subject-contexts.index']"
    >
        <a href="{{route("subject-contexts.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.subject_context_create_subtitle')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:subject-context.subject-context-table theme="tailwind" />
            </div>
        </div>
    </div>


@endsection
