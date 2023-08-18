@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Редактировать новый предмет'"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('subject.update', $subject->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <livewire:subject.subject-edit :subject="$subject" />
                    <livewire:image-upload :folder-name="'subjects'" :id="$subject->image_url != null ? $subject->image_url : 0"/>
                    <div class="my-3">
                        <x-button type="submit" primary label="Обновить" />
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
