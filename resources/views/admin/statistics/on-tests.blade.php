@extends('layouts.default')
@push('css')
    <style>
        .border { border: 1px solid #000000 !important;}
    </style>
@endpush
@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:statistic.on-test />
            </div>
        </div>
    </div>


@endsection
