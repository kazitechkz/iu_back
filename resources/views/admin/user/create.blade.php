@extends('layouts.default')
@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="text-red-500 text-sm">hello</h1>
                <x-input wire:model="name" label="Name" placeholder="User's first name" />
                <x-native-select

                    label="Select Status"

                    placeholder="Select one status"

                    :options="['Active', 'Pending', 'Stuck', 'Done']"

                    wire:model="model"

                />
            </div>
        </div>
    </div>


@endsection
