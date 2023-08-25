<x-form-component.form-component
    :method="'post'"
    :route="'tournament.store'"
    :element-id="'tournament-create'"
>

    {{-- Single Question Quantity --}}
    <div class="form-group">
        <x-inputs.number
            label="Single Question Quantity*"
            wire:model="single_question_quantity"
            hint="Single Question Quantity"
        />
    </div>
    {{-- Single Question Quantity --}}
    {{-- Multiple Question Quantity --}}
    <div class="form-group">
        <x-inputs.number
            label="Multiple Question Quantity*"
            wire:model="multiple_question_quantity"
            hint="Multiple Question Quantity"
        />
    </div>
    {{-- Multiple Question Quantity --}}
    {{-- Context Question Quantity --}}
    <div class="form-group">
        <x-inputs.number
            label="Context Question Quantity*"
            wire:model="context_question_quantity"
            hint="Context Question Quantity"
        />
    </div>
    {{-- Context Question Quantity --}}
    {{-- Time in minutes --}}
    <div class="form-group">
        <x-inputs.number
            label="Time in minutes*"
            wire:model="time"
            hint="Time in minutes"
        />
    </div>
    {{-- Time in minutes --}}
    {{-- Start At --}}
    <x-datetime-picker
        label="Start At *"
        time-format="24"
        parse-format="DD-MM-YYYY HH:mm"
        :min="now()"
        :max="now()->addYear(2)"
        wire:model="start_at"
        hint="Start At"
    />
    {{--Start At --}}
    {{-- End At --}}
    <x-datetime-picker
        label="End At *"
        time-format="24"
        parse-format="DD-MM-YYYY HH:mm"
        :min="now()"
        :max="now()->addYear(2)"
        wire:model="end_at"
        hint="End At"
    />
    {{--End At --}}
</x-form-component.form-component>
