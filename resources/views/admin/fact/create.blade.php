@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать новый факт'"
        :subtitle="'Блок создания нового факта'"

    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('fact.store')}}" method="post">
                    @csrf
                    <div class="my-3">
                        <x-select
                            label="Предмет"
                            name="subject_id"
                            placeholder="Выберите предмет"
                            :options="$subjects"
                            option-label="title"
                            option-value="id"
                            {{--            class="hover:bg-primary-500"--}}
                        />
                    </div>
                    <div class="md:flex lg:flex justify-between my-3">
                        <div class="w-full">
                            <x-ckeditor :input-name="'text_kk'" :title="'Текст на каз'"/>
                        </div>
                    </div>
                    <div class="md:flex lg:flex justify-between my-3">
                        <div class="w-full">
                            <x-ckeditor :input-name="'text_ru'" :title="'Текст на рус'"/>
                        </div>
                    </div>
                    <div class="my-3">
                        <x-button type="submit" primary label="Сохранить" />
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
