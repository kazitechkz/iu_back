<x-form-component.form-component
    :method="'put'"
    :route="'plan-combination.update'"
    :parameters="['plan_combination'=>$planCombination]"
    :element-id="'plan-combination-edit'"
>
    {{--    Plans --}}
    <div class="form-group">
        <x-select
            label="{{__('table.plan_id')}}*"
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
                 label="{{__('table.tag')}}*"
                 placeholder="{{__('table.tag')}}"
                 icon="pencil"
                 hint="{{__('table.tag_hint')}}"
        />
    </div>
    {{--    Tag--}}
    {{--    Country --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="country"
                 label="{{__('table.country')}}*"
                 placeholder="{{__('table.country')}}"
                 icon="pencil"
                 hint="{{__('table.country')}} (3166-1 alpha-3 f.e ESP,KAZ,USA)"
        />
    </div>
    {{--    Country--}}

    {{-- Price --}}
    <div class="form-group">
        <x-inputs.number
            label="{{__('table.price')}}*"
            prefix="KZT"
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
            hint="{{__('table.invoice_period')}}"
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
</x-form-component.form-component>

