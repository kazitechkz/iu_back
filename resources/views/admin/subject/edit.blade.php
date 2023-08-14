@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать новый предмет'"
        :subtitle="'Блок создания нового предмета'"

    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('subject.update', $subject->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <livewire:subject.subject-edit :subject="$subject" />
                    <livewire:image-upload :id="$subject->image_url != null ? $subject->image_url : 0"/>
                    <div class="my-3">
                        <x-button type="submit" primary label="Сохранить" />
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
