<x-form-component.form-component
    :method="'post'"
    :route="'plan-combination.store'"
    :element-id="'plan-combination-create'"
>
    {{--    Plans --}}
    <div class="form-group">
        <x-select
            label="Plan*"
            :options="$plans"
            option-label="name"
            option-value="id"
            wire:model="plan_id"
            name="plan_id"
        />
    </div>
    {{--    Plans--}}
    {{--    Tag --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="tag"
                 label="Tag*"
                 placeholder="Tag f.e free, standart, basic"
                 icon="pencil"
                 hint="Tag is identifier of plan it is required to write it in english"
        />
    </div>
    {{--    Tag--}}
    {{--    Country --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="country"
                 label="Country*"
                 placeholder="Country Code"
                 icon="pencil"
                 hint="Country Code in ISO 3166-1 alpha-3 f.e ESP,KAZ,USA"
        />
    </div>
    {{--    Name--}}

    {{-- Price --}}
    <div class="form-group">
        <x-inputs.number
            label="Price*"
            prefix="KZT"
            wire:model="price"
            hint="Price"
        />
    </div>
    {{-- Price --}}
    {{-- signup_fee --}}
    <div class="form-group">
        <x-inputs.number
            label="Sign Up Fee*"
            wire:model="signup_fee"
            hint="Price for signup may be 0"
        />
    </div>
    {{-- signup_fee --}}
    {{-- currency--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="currency"
                 label="Currency*"
                 placeholder="KZT USD EUR "
                 icon="pencil"
                 hint="Currency in ISO 4217 format"
        />
    </div>
    {{-- currency --}}
    {{-- Invoice Period --}}
    <div class="form-group">
        <x-inputs.number
            label="Invoice Period*"
            wire:model="invoice_period"
            hint="For example 0 days, 1 month etc"
        />
    </div>
    {{-- Invoice Period --}}
    {{--    Invoice Interval --}}
    <div class="form-group">
        <x-select
            label="Invoice Interval*"
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
</x-form-component.form-component>

