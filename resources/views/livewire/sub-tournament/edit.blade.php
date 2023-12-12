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
    <div class="form-group">
        <x-datepicker
            label="{{__('table.start_at')}} *" wire:model="start_at"
            :config="['altFormat' => 'd.m.Y, H:i','enableTime'=>true,'time_24hr'=>true]"
            name="start_at"
            class="placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm pl-8 my-2" />
    </div>
    {{--Start At --}}
    {{-- End At --}}
    <div class="form-group">
        <x-datepicker
            label="{{__('table.end_at')}} *" wire:model="end_at"
            :config="['altFormat' => 'd.m.Y, H:i','enableTime'=>true,'time_24hr'=>true]"
            name="end_at"
            class="placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm pl-8 my-2" />
    </div>
    {{--End At --}}
</x-form-component.form-component>
