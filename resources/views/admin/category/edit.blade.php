@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Редактировать категорию'"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('categories.update', $cat->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <livewire:category.edit :item="$cat" />
                    <div class="my-3">
                        <x-button type="submit" primary label="Обновить" />
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
