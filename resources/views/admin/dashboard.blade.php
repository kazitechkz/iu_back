@extends('layouts.default')
@push('css')
    <style>
        .chart-container {
            width: 100%; /* Устанавливаем ширину в 100% */
        }
    </style>
@endpush
@section('content')
    @can("dashboard management")
        <div class="container p-2 mx-auto">
            <div class="">
                <form action="{{route('admin-dashboard.date-by-filter')}}" class="flex py-3" method="post">
                    @csrf
                    <div class="mx-2">
                        <input type="date" class="form-control" name="from">
                    </div>
                    <div class="mx-2">
                        <input type="date" class="form-control" name="to">
                    </div>
                    <div class="mx-2">
                        <button class="btn bg-primary text-white h-full">Поиск</button>
                    </div>
                </form>
            </div>
            <div class="bg-white rounded shadow">
                {!! $chart->container() !!}
            </div>
        </div>
        <div class="container p-2 mx-auto">
            <div class="bg-white rounded shadow">
                {!! $subjectChart->container() !!}
            </div>
        </div>
    @endcan

@endsection
@push('js')
    <script src="{{ $chart->cdn() }}"></script>
    <script src="{{ $subjectChart->cdn() }}"></script>
    {{ $chart->script() }}
    {{ $subjectChart->script() }}
@endpush
