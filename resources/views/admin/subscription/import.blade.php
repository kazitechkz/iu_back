@extends('layouts.default')
@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('post-subs-import')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="time">Выберите время подписки</label>
                    <select name="time" id="time" class="form-control">
                        <option value="1">1 мес</option>
                        <option value="3">3 мес</option>
                        <option value="6">6 мес</option>
                    </select>
                    <div class="my-3">
                        <input type="file" class="form-control" name="file">
                    </div>

                    <input type="submit" class="btn bg-primary-500 text-white" value="Отправить">
                </form>
            </div>
        </div>
    </div>


@endsection
