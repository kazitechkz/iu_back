@extends('layouts.default')

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:statistic.on-user-content />
            </div>
        </div>
    </div>


@endsection
@push('js')
    <livewire:scripts />
    @livewireChartsScripts
@endpush
