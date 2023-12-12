<x-form-component.form-component
    :method="'put'"
    :route="'lesson-schedule.update'"
    :parameters="['lesson_schedule'=>$lesson_schedule]"
    :element-id="'lesson-schedule-update'"
>
    {{--    Tutor  --}}
    <div class="form-group">
        <x-select
            label="{{__('table.tutor')}}*"
            :options="$tutors"
            option-label="email"
            option-description="email"
            option-value="id"
            wire:model="tutor_id"
            name="tutor_id"
        />
    </div>
    {{--    Tutor--}}
    {{-- Price --}}
    <div class="form-group">
        <x-inputs.number
            label="{{__('table.price')}}*"
            prefix="KZT"
            placeholder="1000"
            wire:model="price"
            hint="{{__('table.price')}}"
        />
    </div>
    {{-- Price --}}
    {{-- Amount --}}
    <div class="form-group">
        <x-inputs.number
            label="{{__('table.amount')}}*"
            wire:model="amount"
            hint="{{__('table.amount')}}"
        />
    </div>
    {{-- Amount --}}

    {{--    Meeting Info --}}
    <div class="form-group">
        <x-textarea
            wire:model="meeting_info"
            label="{{__('table.meeting_info')}}*"
            placeholder="{{__('table.meeting_info')}}"
            hint="{{__('table.meeting_info')}}"
        />
    </div>
    {{--    Meeting Info --}}
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
            us:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm pl-8 my-2" />
    </div>
    {{--End At --}}
</x-form-component.form-component>
