@extends('layouts.default')
@push('css')
    <style>
        table {
            border: 1px solid #0a0e17!important;
        }
        table th {
            border: 1px solid #0a0e17!important;
        }
        table td {
            border: 1px solid #0a0e17!important;
        }
    </style>
@endpush
@section('content')
    <x-layer-components.content-navbar
        :title="'UTM статистика'"
        :subtitle="''"
    >

    </x-layer-components.content-navbar>

    <livewire:utm.statistic />

@endsection
