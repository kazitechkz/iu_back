@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Редактировать тест по предмету'"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('single-tests.update', $singleSubjectTest->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <livewire:single-subject-test.edit :item="$singleSubjectTest" />
                    <div class="my-3">
                        <x-button type="submit" primary label="Обновить" />
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
