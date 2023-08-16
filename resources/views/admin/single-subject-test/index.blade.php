@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Тестирование по предметам'">

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:single-subject-test.single-subject-test-table theme="tailwind" />
            </div>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('single-subject-tests.store')}}" method="post">
                    @csrf
                    <livewire:single-subject-test.create />
                    <div class="my-3">
                        <x-button type="submit" primary label="Сохранить" />
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

