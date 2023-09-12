<x-form-component.form-component
    :method="'post'"
    :route="'tournament.store'"
    :element-id="'tournament-create'"
>
    {{--    Tutor  --}}
    <div class="form-group">
        <x-select
            label="{{__('table.tutor')}}*"
            :options="$tutors"
            option-label="name"
            option-description="email"
            option-value="id"
            wire:model="tutor_id"
            name="tutor_id"
        />
    </div>
    {{--    Tutor--}}
    {{--    Subject  --}}
    <div class="form-group">
        <x-select
            label="{{__('table.subject_id')}}*"
            :options="$subjects"
            option-label="title_ru"
            option-value="id"
            wire:model="subject_id"
            name="subject_id"
        />
    </div>
    {{--    Subject--}}
    {{--    Category  --}}
    <div class="form-group">
        <x-select
            label="{{__('table.category_id')}}*"
            :options="$categories"
            option-label="title_ru"
            option-value="id"
            wire:model="category_id"
            name="category_id"
        />
    </div>
    {{--    Category--}}

</x-form-component.form-component>
