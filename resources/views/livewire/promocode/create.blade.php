<x-form-component.form-component
    :method="'post'"
    :route="'promocode.store'"
    :element-id="'promocode-create'"
>
    {{-- Usage --}}
    <div class="form-group">
        <x-inputs.number
            label="Usage*"
            max="1000"
            min="1"
            wire:model="usages"
            hint="How many times promocode can be used, it is recomended - only one"
        />
    </div>
    {{-- Usage --}}
    {{-- Count --}}
    <div class="form-group">
        <x-inputs.number
            label="Count*"
            max="1000"
            min="1"
            wire:model="count"
            hint="How many unique promocode should be generated, maximum - 1000"
        />
    </div>
    {{-- Count --}}

    {{-- Point --}}
    <div class="form-group">
        <x-inputs.number
            label="Point*"
            max="10000"
            min="1"
            wire:model="points"
            hint="How many points - ui coins we can receive, 1KZT = 1 UI COIN"
        />
    </div>
    {{-- Point --}}

    {{--Expiration Date --}}
    <x-datetime-picker
        label="Expiration Date"
        time-format="24"
        parse-format="DD-MM-YYYY HH:mm"
        :min="now()"
        :max="now()->addYear(2)"
        wire:model="expiration_date"
        hint="Expiration Date - when it comes user cant use it"
    />
    {{--Expiration Date --}}
</x-form-component.form-component>
