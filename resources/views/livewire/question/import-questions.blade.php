@extends('layouts.default')
@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('import-from-csv')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" accept=".xlsx, .xls, .csv">
                    <button type="submit" class="btn btn-outline-success">Отправить</button>
                </form>
            </div>
        </div>
    </div>


@endsection

