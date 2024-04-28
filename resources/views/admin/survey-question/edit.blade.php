@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Анализ ответов'"
        :breadcrumbs="['Список опросников',__('table.announcement_edit_title')]"
        :routes="['survey.index']"
    />
    <div class="flex my-2">
        <a href="{{route('survey-question-filter.id.locale-id', ['surveyID' => $surveyID, 'localeID' => 1])}}" class="mx-2">KAZ</a>
        <a href="{{route('survey-question-filter.id.locale-id', ['surveyID' => $surveyID, 'localeID' => 2])}}" class="mx-2">RUS</a>
    </div>
    @foreach($data as $key => $value)
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h3>{{$key}}</h3>
                    @foreach($value as $k => $v)
                        <p>{{$k}} - {{count($v)}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
@endsection
