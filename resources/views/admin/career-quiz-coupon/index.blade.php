@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.career_coupons_lists')"
        :subtitle="__('table.career_coupons_management')"
        :breadcrumbs="[__('table.career_coupons_management')]"
        :routes="['career-quiz-author.index']"
    >
        <a href="{{route("career-quiz-coupon.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.career_coupons_create_title')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:career-quiz-coupons.career-quiz-coupon-table/>
            </div>
        </div>
    </div>


@endsection
