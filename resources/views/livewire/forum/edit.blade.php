<x-form-component.form-component
    :method="'put'"
    :route="'forum.update'"
    :parameters="['forum'=>$forum]"
    :element-id="'forum-update'"
>

    {{--    Text --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="text"
                 label="Title*"
                 placeholder="Title"
                 icon="pencil"
                 hint="Title"
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
            label="Subject"
            wire:model="subject_id"
            placeholder="Выберите предмет"
            :options="$subjects"
            option-label="title_ru"
            option-value="id"
        />
    </div>
    {{--    Subject --}}

</x-form-component.form-component>
