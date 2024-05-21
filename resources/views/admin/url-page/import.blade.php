@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Import Page'"
        :subtitle="''"
    />

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('url-page.post-import')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" class="form-control" name="file">
                    <input type="submit" class="btn bg-primary-500 text-white" value="Отправить">
                </form>
            </div>
        </div>
    </div>


@endsection
