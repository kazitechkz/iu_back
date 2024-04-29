@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Анализ ответов'"
        :breadcrumbs="['Список опросников',__('table.announcement_edit_title')]"
        :routes="['survey.index']"
    />
    <div class="flex my-4 justify-content-center">
        <a href="{{route('survey-question-filter.id.locale-id', ['surveyID' => $surveyID, 'localeID' => 1])}}" class="mx-2">KAZ</a>
        <a href="{{route('survey-question-filter.id.locale-id', ['surveyID' => $surveyID, 'localeID' => 2])}}" class="mx-2">RUS</a>
    </div>
    @foreach($data as $key => $value)
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5>{{$key}}</h5>
                    @foreach($value as $k => $v)
                        <p>{{$k}} - {{count($v)}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach

    <h3 class="my-3">Пожелания</h3>
    @foreach($wishes as $value)

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    {{$value->user->name}}
                </div>
                <div class="card-body">
                    {{$value->wishes}}
                </div>
            </div>
        </div>
    @endforeach
    <div class="my-3">
        {!! $wishes->links() !!}
    </div>


@endsection
