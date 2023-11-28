@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.tech_support_ticket_edit_title')"
        :subtitle="__('table.tech_support_ticket_edit_subtitle')"
        :breadcrumbs="[__('table.tech_support_ticket_management'),__('table.tech_support_ticket_edit_title')]"
        :routes="['tech-support-ticket.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:tech-support-ticket.edit :tech_support_ticket="$techSupportTicket"/>
            </div>
        </div>
    </div>


@endsection
