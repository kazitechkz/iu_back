<x-form-component.form-component
    :method="'put'"
    :route="'faq.update'"
    :parameters="['faq'=>$faq]"
    :element-id="'faq-edit'"
>
    {{--    Locales --}}
    <div class="form-group">
        <x-select
            label="{{__('table.locale_id')}}*"
            :options="$locales"
            option-label="title"
            option-value="id"
            wire:model="locale_id"
            name="locale_id"
        />
    </div>
    {{--    Locales--}}
    {{--    Question --}}
    <div class="form-group">
        <x-textarea
            wire:model="question"
            label="{{__('table.question_id')}}*"
            placeholder="Question"
            hint="Question of plan"
        />
    </div>
    {{--    Question --}}
    {{--    Answer --}}
    <div class="form-group">
        <x-textarea
            wire:model="answer"
            label="{{__('table.answer')}}*"
            placeholder="{{__('table.answer')}}"
            hint="Answer of plan"
        />
    </div>
    {{--    Answer --}}

    {{-- Is Active --}}
    <div class="form-group">
        <x-checkbox
            id="is_active"
            label="{{__('table.is_active')}}"
            icon="check"
            wire:model.defer="is_active"
        />
    </div>
    {{-- Is Active --}}

</x-form-component.form-component>

