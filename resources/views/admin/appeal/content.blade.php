@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.appeal_lists')"
        :subtitle="''"
    >
    </x-layer-components.content-navbar>

    <livewire:appeal.content-table />

@endsection

