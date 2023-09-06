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
            wire:model.defer="is_active"
        />
    </div>
    {{-- Is Active --}}
    {{--    Commercial Group --}}
    <div class="form-group">
        <x-select
            label="Commercial Group*"
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
            label="Price*"
            prefix="KZT"
            wire:model="price"
            hint="Price in Kazakh Tenge"
        />
    </div>
    {{-- Price --}}
    {{-- signup_fee --}}
    <div class="form-group">
        <x-inputs.number
            label="Sign Up Fee*"
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
    {{-- Trial Period --}}
    <div class="form-group">
        <x-inputs.number
            label="Count of Trial*"
            wire:model="trial_period"
            hint="For example 0 days, 1 month etc"
        />
    </div>
    {{-- Trial Period --}}
    {{--    Trial Interval --}}
    <div class="form-group">
        <x-select
            label="Trial Interval*"
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
            hint="Inside (30=3trial + 27paid) and Outside(30=3trial + 30paid)"
        />
    </div>
    {{--    Trial Mode --}}
    {{-- Grace Period --}}
    <div class="form-group">
        <x-inputs.number
            label="Grace Period*"
            wire:model="grace_period"
            hint="For example 0 days, 1 month etc"
        />
    </div>
    {{-- Grace Period --}}
    {{--    Grace Interval --}}
    <div class="form-group">
        <x-select
            label="Grace Interval*"
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
