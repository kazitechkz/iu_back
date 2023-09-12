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
