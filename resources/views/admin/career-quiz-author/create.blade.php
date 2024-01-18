@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.career_quiz_authors_create_title')"
        :subtitle="__('table.career_quiz_authors_create_subtitle')"
        :breadcrumbs="[__('table.career_quiz_authors_management'),__('table.career_quiz_authors_create_title')]"
        :routes="['career-quiz-author.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:career-quiz-author.create/>
            </div>
        </div>
    </div>


@endsection
