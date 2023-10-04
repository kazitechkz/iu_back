<x-form-component.form-component
    :method="'post'"
    :route="'sub-step-video.store'"
    :element-id="'sub-step-video-create'"
>
    {{--    Subjects --}}
    <div class="form-group">
        <x-select
            label="Предметы*"
            :options="$subjects"
            option-label="title"
            option-value="id"
            wire:model="subject_id"
        />
    </div>
    {{--    Subjects --}}
    {{--    Steps --}}
    <div class="form-group">
        <x-select
            label="Cтепы*"
            :options="$steps"
            option-label="title"
            option-value="id"
            wire:model="step_id"
        />
    </div>
    {{--    Steps --}}
    {{--    Sub-Steps --}}
    <div class="form-group">
        <x-select
            label="Субстепы*"
            :options="$sub_steps"
            option-label="title"
            option-value="id"
            wire:model="sub_step_id"
            name="sub_step_id"
        />
    </div>
    {{--    Sub-Steps --}}

    <div class="form-group">
        <x-input class="my-2"
                 wire:model="url"
                 label="URL from YouTube"
                 placeholder="URL from YouTube"
                 icon="pencil"
        />
    </div>

</x-form-component.form-component>
