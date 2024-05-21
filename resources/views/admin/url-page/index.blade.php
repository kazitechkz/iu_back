@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Url адреса'"
        :subtitle="''"
    >
        <a href="{{route("url-pages.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            Добавить новый адрес
        </a>

    </x-layer-components.content-navbar>
    <livewire:url-page.index-table />
@endsection
