@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать новую субкатегорию'"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('sub-categories.store')}}" method="post">
                    @csrf
                    <livewire:sub-category.create />
                    <div class="my-3">
                        <x-button type="submit" primary label="Сохранить" />
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
