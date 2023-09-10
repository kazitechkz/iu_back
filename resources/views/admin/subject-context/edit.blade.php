@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.subject_context_edit_title')"
        :subtitle="__('table.subject_context_edit_subtitle')"
        :breadcrumbs="[__('table.subject_context_management'),__('table.subject_context_edit_title')]"
        :routes="['subject-contexts.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('subject-contexts.update', $ctx->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <livewire:subject-context.edit :ctx="$ctx"/>
                    <div class="my-3">
                        <x-button type="submit" primary label="Обновить" />
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
