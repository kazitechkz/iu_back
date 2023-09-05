@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Редактировать субкатегорию'"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('sub-categories.update', $subCategory->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <livewire:sub-category.edit :sub-category="$subCategory" />
                    <div class="my-3">
                        <x-button type="submit" primary label="Обновить" />
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
