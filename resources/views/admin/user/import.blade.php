@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.user_create_title')"
        :subtitle="__('table.user_create_subtitle')"
        :breadcrumbs="[__('table.user_management'),__('table.user_create_title')]"
        :routes="['user.index']"
    />

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('post-user-import')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" class="form-control" name="file">
                    <input type="submit" class="btn bg-primary-500 text-white" value="Отправить">
                </form>
            </div>
        </div>
    </div>


@endsection
