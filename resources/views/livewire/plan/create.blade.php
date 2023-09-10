<x-form-component.form-component
    :method="'post'"
    :route="'plan.store'"
    :element-id="'plan-create'"
>

    {{--    Tag --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="tag"
                 label="{{__('table.tag')}}*"
                 placeholder="{{__('table.tag')}}"
                 icon="pencil"
                 hint="{{__('table.tag_hint')}}"
        />
    </div>
    {{--    Tag--}}
    {{--    Name --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="name"
                 label="{{__('table.name')}}*"
                 placeholder="{{__('table.name')}}, like Basic,Standart,Pro"
                 icon="pencil"
                 hint="{{__('table.name')}}"
        />
    </div>
    {{--    Name--}}
    {{--    Description--}}
    <div class="form-group">
        <x-textarea
            wire:model="description"
            label="{{__('table.description')}}*"
            placeholder="{{__('table.description')}}"
            hint="{{__('table.description')}}"
        />
    </div>
    {{--    Description --}}

    {{-- Is Active --}}
    <div class="form-group">
        <x-checkbox
            id="is_active"
            label="{{__('table.is_active')}}"
            icon="check"
            wire:model.defer="is_active"
        />
    </div>
    {{-- Is Active --}}
    {{--    Commercial Group --}}
    <div class="form-group">
        <x-select
            label="{{__('table.commercial_group_id')}}*"
            :options="$commercial_groups"
            option-label="title_ru"
            option-value="id"
            wire:model="commercial_group_id"
            name="commercial_group_id"
        />
    </div>
    {{--    Commercial Group --}}
    {{-- Price --}}
    <div class="form-group">
        <x-inputs.number
            label="{{__('table.price')}}*"
            prefix="KZT"
            placeholder="1000"
            wire:model="price"
            hint="{{__('table.price')}}"
        />
    </div>
    {{-- Price --}}
    {{-- signup_fee --}}
    <div class="form-group">
        <x-inputs.number
            label="{{__('table.sign_up_fee')}}*"
            wire:model="signup_fee"
            hint="{{__('table.sign_up_fee')}}"
        />
    </div>
    {{-- signup_fee --}}
    {{-- currency--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="currency"
                 label="{{__('table.currency')}}*"
                 placeholder="KZT USD EUR "
                 icon="pencil"
                 hint="{{__('table.currency_hint')}}"
        />
    </div>
    {{-- currency --}}
    {{-- Invoice Period --}}
    <div class="form-group">
        <x-inputs.number
            label="{{__('table.invoice_period')}}*"
            wire:model="invoice_period"
            hint="{{__('table.invoice_hint')}}"
        />
    </div>
    {{-- Invoice Period --}}
    {{--    Invoice Interval --}}
    <div class="form-group">
        <x-select
            label="{{__('table.invoice_interval')}}*"
            :options="[
                ['name'=>'Hour','value'=>'hour'],
                ['name'=>'Day','value'=>'day'],
                ['name'=>'Week','value'=>'week'],
                ['name'=>'Month','value'=>'month'],
            ]"
            option-label="name"
            option-value="value"
            wire:model="invoice_interval"
            name="invoice_interval"
        />
    </div>
    {{--    Invoice Interval --}}
    {{-- Trial Period --}}
    <div class="form-group">
        <x-inputs.number
            label="{{__('table.trial_period')}}*"
            wire:model="trial_period"
            hint="{{__('table.trial_hint')}}"
        />
    </div>
    {{-- Trial Period --}}
    {{--    Trial Interval --}}
    <div class="form-group">
        <x-select
            label="{{__('table.trial_interval')}}*"
            :options="[
                ['name'=>'Hour','value'=>'hour'],
                ['name'=>'Day','value'=>'day'],
                ['name'=>'Week','value'=>'week'],
                ['name'=>'Month','value'=>'month'],
            ]"
            option-label="name"
            option-value="value"
            wire:model="trial_interval"
            name="trial_interval"
        />
    </div>
    {{--    Trial Interval --}}
    {{--    Trial Mode --}}
    <div class="form-group">
        <x-select
            label="Trial Mode*"
            :options="[
                ['name'=>'Inside','value'=>'inside'],
                ['name'=>'Outside','value'=>'outside'],
            ]"
            option-label="name"
            option-value="value"
            wire:model="trial_mode"
            name="trial_mode"
            hint="{{__('table.trial_mode_hint')}}"
        />
    </div>
    {{--    Trial Mode --}}
    {{-- Grace Period --}}
    <div class="form-group">
        <x-inputs.number
            label="{{__('table.grace_period')}}*"
            wire:model="grace_period"
            hint="{{__('table.grace_hint')}}"
        />
    </div>
    {{-- Grace Period --}}
    {{--    Grace Interval --}}
    <div class="form-group">
        <x-select
            label="{{__('table.grace_interval')}}*"
            :options="[
                ['name'=>'Not Grace Period','value'=>null],
                ['name'=>'Hour','value'=>'hour'],
                ['name'=>'Day','value'=>'day'],
                ['name'=>'Week','value'=>'week'],
                ['name'=>'Month','value'=>'month'],
            ]"
            option-label="name"
            option-value="value"
            wire:model="grace_interval"
            name="grace_interval"
        />
    </div>
    {{--    Grace Interval --}}
</x-form-component.form-component>
