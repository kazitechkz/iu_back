@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.subject_context_create_title')"
        :subtitle="__('table.subject_context_create_subtitle')"
        :breadcrumbs="[__('table.subject_context_management'),__('table.subject_context_create_title')]"
        :routes="['subject-contexts.index']"

    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('subject-contexts.store')}}" method="post">
                    @csrf
                    <livewire:subject-context.create/>
                    <div class="my-3">
                        <x-button type="submit" primary label="Сохранить" />
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
