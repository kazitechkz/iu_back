@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.career_coupons_create_title')"
        :subtitle="__('table.career_coupons_create_subtitle')"
        :breadcrumbs="[__('table.career_coupons_management'),__('table.career_coupons_create_title')]"
        :routes="['career-quiz-coupon.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:career-quiz-coupons.create/>
            </div>
        </div>
    </div>


@endsection
