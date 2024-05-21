@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Блок создания URL адреса'"
        :subtitle="''"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('url-pages.store')}}" method="post">
                    @csrf
                    <input type="text" class="form-control my-2" name="title" placeholder="Введите наименование">
                    <input type="text" class="form-control my-2" name="url" placeholder="Введите url">
                    <input type="submit" class="form-control btn bg-primary text-white" value="Отправить">
                </form>
            </div>
        </div>
    </div>


@endsection
