@extends('layouts.default')
@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <h1>{{$user->name}}</h1>
                <p>{{$user->email}}</p>
                <p>Balance: {{$user->balanceInt}} iu</p>
            </div>
            <div class="card-body">
                <form action="{{route('post-iu-coins')}}" method="post">
                    @csrf
                    <input type="hidden" name="user" class="form-control" value="{{$user->id}}">
                    <input type="number" name="balance" class="form-control">
                    <button type="submit" class="my-3 btn btn-success bg-success">Сохранить</button>
                </form>
            </div>
        </div>
    </div>


@endsection
