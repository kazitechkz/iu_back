<x-form-component.form-component
    :method="'put'"
    :route="'sub-tournament.update'"
    :parameters="['sub_tournament'=>$subTournament]"
    :element-id="'sub-tournament-update'"
>
    {{--    Tournament  --}}
    <div class="form-group">
        <x-select
            label="{{__('table.tournament_id')}}*"
            :options="$tournaments"
            option-label="title_ru"
            option-value="id"
            wire:model="tournament_id"
            name="tournament_id"
        />
    </div>
    {{--    Tournament--}}
    {{--    Step  --}}
    <div class="form-group">
        <x-select
            label="{{__('table.tournament_step_id')}}*"
            :options="$steps"
            option-label="title_ru"
            option-value="id"
            wire:model="step_id"
            name="step_id"
        />
    </div>
    {{--    Step--}}
    {{-- Single Question Quantity --}}
    <div class="form-group">
        <x-inputs.number
            label="{{__('table.single_question_quantity')}}*"
            wire:model="single_question_quantity"
            hint="{{__('table.single_question_quantity')}}"
        />
    </div>
    {{-- Single Question Quantity --}}
    {{-- Multiple Question Quantity --}}
    <div class="form-group">
        <x-inputs.number
            label="{{__('table.multiple_question_quantity')}}*"
            wire:model="multiple_question_quantity"
            hint="{{__('table.multiple_question_quantity')}}"
        />
    </div>
    {{-- Multiple Question Quantity --}}
    {{-- Context Question Quantity --}}
    <div class="form-group">
        <x-inputs.number
            label="{{__('table.context_question_quantity')}}*"
            wire:model="context_question_quantity"
            hint="{{__('table.context_question_quantity')}}"
        />
    </div>
    {{-- Context Question Quantity --}}
    {{-- Time in minutes --}}
    <div class="form-group">
        <x-inputs.number
            label="{{__('table.time')}}*"
            wire:model="time"
            hint="{{__('table.time')}}"
        />
    </div>
    {{-- Time in minutes --}}
    {{-- Start At --}}
    <x-datetime-picker
        label="{{__('table.start_at')}} *"
        time-format="24"
        parse-format="DD-MM-YYYY HH:mm"
        :min="now()"
        :max="now()->addYear(2)"
        wire:model="start_at"
        hint="{{__('table.start_at')}}"
    />
    {{--Start At --}}
    {{-- End At --}}
    <x-datetime-picker
        label="{{__('table.end_at')}} *"
        time-format="24"
        parse-format="DD-MM-YYYY HH:mm"
        :min="now()"
        :max="now()->addYear(2)"
        wire:model="end_at"
        hint="{{__('table.end_at')}}"
    />
    {{--End At --}}
</x-form-component.form-component>
