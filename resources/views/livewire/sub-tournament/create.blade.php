<x-form-component.form-component
    :method="'post'"
    :route="'sub-tournament.store'"
    :element-id="'sub-tournament-create'"
>
    {{--    Tournament  --}}
    <div class="form-group">
        <x-select
            label="Tournaments*"
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
            label="Steps*"
            :options="$steps"
            option-label="title_ru"
            option-value="id"
            wire:model="step_id"
            name="step_id"
        />
    </div>
    {{--    Step--}}
    {{--  End SubTournament --}}
    @if(count($steps) == 0 && !$tournament_winner)
    <div class="form-group">
        <a wire:click="finishTournament" class="cursor-pointer text-white px-4 py-2 bg-red-400 rounded-full">
            Завершить
        </a>
    </div>
    @endif
    {{--  End SubTournament --}}

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
