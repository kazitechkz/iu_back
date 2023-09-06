@extends('layouts.default')
@push('css')

@endpush
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать новый вопрос'"
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
                <form action="{{route('questions.store')}}" method="post">
                    @csrf
                    <livewire:question.create />

                    <div class="my-3">
                        <x-button type="submit" primary label="Сохранить" />
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
@push('js')

@endpush
