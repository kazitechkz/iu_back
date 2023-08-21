<x-form-component.form-component
    :method="'post'"
    :route="'faq.store'"
    :element-id="'faq-create'"
>
    {{--    Locales --}}
    <div class="form-group">
        <x-select
            label="Locale*"
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
            label="Question*"
            placeholder="Question"
            hint="Question of plan"
        />
    </div>
    {{--    Question --}}
    {{--    Answer --}}
    <div class="form-group">
        <x-textarea
            wire:model="answer"
            label="Answer*"
            placeholder="Answer"
            hint="Answer of plan"
        />
    </div>
    {{--    Answer --}}

    {{-- Is Active --}}
    <div class="form-group">
        <x-checkbox
            id="is_active"
            label="Is Active"
            icon="check"
            wire:model.defer="is_active"
        />
    </div>
    {{-- Is Active --}}

</x-form-component.form-component>
