<x-form-component.form-component
    :method="'post'"
    :route="'promocode.store'"
    :element-id="'promocode-create'"
>
    {{-- Usage --}}
    <div class="form-group">
        <x-inputs.number
            label="{{__('table.usages')}}*"
            max="1000"
            min="1"
            wire:model="usages"
            hint="{{__('table.usages_hint')}}"
        />
    </div>
    {{-- Usage --}}
    {{-- Count --}}
    <div class="form-group">
        <x-inputs.number
            label="{{__('table.count')}}*"
            max="1000"
            min="1"
            wire:model="count"
            hint="{{__('table.count_hint')}}"
        />
    </div>
    {{-- Count --}}

    {{-- Point --}}
    <div class="form-group">
        <x-inputs.number
            label="{{__('table.point')}}*"
            max="10000"
            min="1"
            wire:model="points"
            hint="{{__('table.point')}}, 1KZT = 1 UI COIN"
        />
    </div>
    {{-- Point --}}

    {{--Expiration Date --}}
    <x-datetime-picker
        label="{{__('table.expiration')}}"
        time-format="24"
        parse-format="DD-MM-YYYY HH:mm"
        :min="now()"
        :max="now()->addYear(2)"
        wire:model="expiration_date"
        hint="{{__('table.expiration')}}"
    />
    {{--Expiration Date --}}
</x-form-component.form-component>
