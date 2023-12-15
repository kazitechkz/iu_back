@extends('layouts.default')
@push('css')
    <style>
        .pie-chart {
            height: 400px;
            margin: 0 auto;
        }
    </style>
@endpush
@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
{{--                <div class="row py-4 my-2">--}}
{{--                    <div id="chartUsers" class="pie-chart"></div>--}}
{{--                </div>--}}
                <livewire:statistic.on-user-content />
            </div>
        </div>
    </div>


@endsection
@push('js')
{{--    <script src="https://www.google.com/jsapi"></script>--}}
{{--    <script type="text/javascript">--}}
{{--        let dataForUser = @json($usersData);--}}
{{--        window.onload = function() {--}}
{{--            google.load("visualization", "1.1", {--}}
{{--                packages: ["corechart"],--}}
{{--                callback: 'drawChart',--}}
{{--                language: 'ru'--}}
{{--            });--}}
{{--        };--}}

{{--        function drawChart() {--}}
{{--            let userData = new google.visualization.DataTable()--}}
{{--            userData.addColumn('string', 'Name');--}}
{{--            userData.addColumn('number', 'Count');--}}
{{--            userData.addRows(userData);--}}

{{--            let userOptions = {--}}
{{--                    // pieHole: 0.4,--}}
{{--                    title: 'Распределение методистов по количеству забитых вопросов',--}}
{{--                    is3D: true,--}}
{{--                    sliceVisibilityThreshold: 0.02,--}}
{{--                    slices: {--}}
{{--                        0: { offset: 0.1 },--}}
{{--                        1: { offset: 0.3 },--}}
{{--                        2: { offset: 0.3 },--}}
{{--                        3: { offset: 0.2 }--}}
{{--                    }--}}
{{--                }--}}
{{--            let chartUsers = new google.visualization.PieChart(document.getElementById('chartUsers'))--}}
{{--            chartUsers.draw(userData, userOptions);--}}
{{--        }--}}
{{--    </script>--}}
@endpush
