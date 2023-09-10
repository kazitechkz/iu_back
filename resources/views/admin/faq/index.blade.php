@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.faq_lists')"
        :subtitle="__('table.faq_management')"
        :breadcrumbs="[__('table.faq_management')]"
        :routes="['faq.index']"
    >
        <a href="{{route("faq.create")}}" class="btn btn-primary mt-2 mt-xl-0">Добавить FAQ</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:faq.faq-table></livewire:faq.faq-table>
            </div>
        </div>
    </div>


@endsection
