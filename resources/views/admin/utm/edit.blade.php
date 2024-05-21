@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Блок редактирования URL адреса'"
        :subtitle="''"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('url-pages.update', $url->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="text" class="form-control my-2" name="title" placeholder="Введите наименование" value="{{$url->title}}">
                    <input type="text" class="form-control my-2" name="url" placeholder="Введите url" value="{{$url->url}}">
                    <input type="submit" class="form-control btn bg-success text-white" value="Обновить">
                </form>
            </div>
        </div>
    </div>


@endsection
