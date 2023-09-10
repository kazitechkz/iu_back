<x-form-component.form-component
    :method="'post'"
    :route="'forum.store'"
    :element-id="'forum-create'"
>

    {{--    Text --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="text"
                 label="{{__('table.text')}}*"
                 placeholder="{{__('table.text')}}"
                 icon="pencil"
                 hint="{{__('table.text')}}"
        />
    </div>
    {{--    Text --}}
    {{--    Attachment --}}
    <div class="form-group" wire:ignore>
        <x-ckeditor :description="$attachment" :input-name="'attachment'" :title="'Attachment'"/>
    </div>
    {{--    Attachment --}}
    {{--    Subject --}}
    <div class="form-group">
        <x-select
            label="{{__('table.subject_id')}}"
            wire:model="subject_id"
            placeholder="{{__('table.subject_id')}}"
            :options="$subjects"
            option-label="title_ru"
            option-value="id"
        />
    </div>
    {{--    Subject --}}

</x-form-component.form-component>
