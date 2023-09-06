@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Редактировать тест'"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('sub-step-test.update', $subStepTest->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <livewire:sub-step-test.sub-step-test-edit :item="$subStepTest" />
                    <div class="my-3">
                        <x-button type="submit" primary label="Обновить" />
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
