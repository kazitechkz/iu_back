<x-form-component.form-component
    :method="'put'"
    :route="'group.update'"
    :parameters="['group'=>$group]"
    :element-id="'group-update'"
>

    {{--    Title in Russian --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_ru"
                 label="Title in Russian*"
                 placeholder="Title in Russian"
                 icon="pencil"
                 hint="Title in Russian"
        />
    </div>
    {{--    Title in Russian --}}
    {{--    Title in Kazakh --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_kk"
                 label="Title in Kazakh*"
                 placeholder="Title in Kazakh"
                 icon="pencil"
                 hint="Title in Kazakh"
        />
    </div>
    {{--    Title in Kazakh --}}
    {{--    Title in English --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_en"
                 label="Title in English*"
                 placeholder="Title in English"
                 icon="pencil"
                 hint="Title in English"
        />
    </div>
    {{--    Title in English --}}

    {{-- Is Active --}}
    <x-checkbox
        id="is_active"
        label="Активный"
        icon="check"
        wire:model.defer="isActive"
    />
    {{-- Is Active --}}
    {{-- Plans --}}
    <p class="h-3 mb-3 font-weight-bold">
        Plan:
    </p>
    <div class="form-group">
        @foreach($plans as $plan)
            <x-checkbox
                value="{{$plan->id}}"
                id="{{$plan->id}}"
                name="planGroups[]"
                multiple="multiple"
                selected
                wire:model="planGroups"
                wire:change="changePlan('{{$plan->id}}')"
                label="{{$plan->name}}{{$plan->id}}"
            />
        @endforeach
    </div>
    {{-- Plans --}}


</x-form-component.form-component>
