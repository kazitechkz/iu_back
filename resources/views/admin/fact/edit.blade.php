@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Редактировать новый предмет'"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('fact.update', $fact->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="my-3">
                        <select name="subject_id" class="form-control">
                            <option selected value="{{$fact->subject_id}}">{{$fact->subject->title_kk}}</option>
                            @foreach($subjects as $subject)
                                @if($subject->id != $fact->subject_id)
                                    <option value="{{$subject->id}}">{{$subject->title_kk}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="md:flex lg:flex justify-between my-3">
                        <div class="w-full">
                            <x-ckeditor :description="$fact->text_kk" :input-name="'text_kk'" :title="'Текст на каз'"/>
                        </div>
                    </div>
                    <div class="md:flex lg:flex justify-between my-3">
                        <div class="w-full">
                            <x-ckeditor :description="$fact->text_ru" :input-name="'text_ru'" :title="'Текст на рус'"/>
                        </div>
                    </div>
                    <div class="my-3">
                        <x-button type="submit" primary label="Обновить" />
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
