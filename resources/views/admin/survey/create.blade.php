@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Блок создания опросника'"
        :breadcrumbs="['Список опросников',__('table.announcement_create_title')]"
        :routes="['survey.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('survey.store')}}" method="post">
                    @csrf
                    <input type="text" name="title" class="form-control my-2" placeholder="Введите наименование">
                    <div class="my-2">
                        <label for="is_subs">Для тех у кого есть подписка</label>
                        <input type="checkbox" name="is_subscription" class="form-control" id="is_subs">
                    </div>
                    <div class="my-2">
                        <label for="status">Активен</label>
                        <input type="checkbox" name="status" class="form-control" id="status">
                    </div>
                    <div class="my-2">
                        <input type="submit" class="btn text-white" value="Отправить" style="background-color: #2caae1"/>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
