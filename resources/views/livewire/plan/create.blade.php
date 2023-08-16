<x-form-component.form-component
    :method="'post'"
    :route="'plan.store'"
    :element-id="'plan-create'"
>

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
    {{--    Name --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="name"
                 label="Name*"
                 placeholder="Name f.e Basic Standart Premium"
                 icon="pencil"
                 hint="Name is identifier of plan it is required to write it in english"
        />
    </div>
    {{--    Name--}}
    {{--    Description--}}
    <div class="form-group">
        <x-textarea
            wire:model="description"
            label="Description*"
            placeholder="Description"
            hint="Description of plan"
        />
    </div>
    {{--    Description --}}

    {{-- Is Active --}}
    <div class="form-group">
        <x-checkbox
            id="is_active"
            label="Is Active"
            icon="check"
            wire:model.defer="isActive"
        />
    </div>
    {{-- Is Active --}}
    {{-- Price --}}
    <div class="form-group">
        <x-inputs.currency
            label="Price*"
            prefix="KZT"
            thousands="."
            wire:model="price"
            hint="Price in Kazakh Tenge"
        />
    </div>
    {{-- Price --}}
    {{-- signup_fee --}}
    <div class="form-group">
        <x-inputs.currency
            label="Sign Up Fee*"
            thousands="."
            wire:model="signup_fee"
            hint="Price in Kazakh Tenge for signup may be 0"
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
    {{-- Trial Period --}}
    <div class="form-group">
        <x-inputs.number
            label="Count of Trial"
            wire:model="trial_period"
            hint="For example 0 days, 1 month etc"
        />
    </div>
    {{-- Trial Period --}}
    {{--    Trial Interval --}}
    <div class="form-group">
        <x-select
            label="Trial Interval"
            :options="[
                ['name'=>'Not Trial Period','value'=>null],
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
            label="Trial Mode"
            :options="[
                ['name'=>'Not Trial Period','value'=>null],
                ['name'=>'Inside','value'=>'inside'],
                ['name'=>'Outside','value'=>'outside'],
            ]"
            option-label="name"
            option-value="value"
            wire:model="trial_mode"
            name="trial_mode"
            hint="Inside (30=3trial + 27paid) and Outside(30=3trial + 30paid)"
        />
    </div>
    {{--    Trial Mode --}}
    {{-- Grace Period --}}
    <div class="form-group">
        <x-inputs.number
            label="Grace Period"
            wire:model="grace_period"
            hint="For example 0 days, 1 month etc"
        />
    </div>
    {{-- Grace Period --}}
    {{--    Grace Interval --}}
    <div class="form-group">
        <x-select
            label="Grace Interval"
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
