<x-form-component.form-component
    :method="'put'"
    :route="'commercial-group.update'"
    :parameters="['commercial_group'=>$commercial_group]"
    :element-id="'commercial-group-create'"
>
    <div class="form-group">
        <x-input class="my-2"
                 type="hidden"
                 wire:model="commercial_group_id"
                 value="{{$commercial_group->id}}"
        />
    </div>
    {{--    Title in Russian --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_ru"
                 label="{{__('table.title_ru')}}*"
                 placeholder="{{__('table.title_ru')}}"
                 icon="pencil"
                 hint="{{__('table.title_ru')}}"
        />
    </div>
    {{--    Title in Russian --}}
    {{--    Title in Kazakh --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_kk"
                 label="{{__('table.title_kk')}}*"
                 placeholder="{{__('table.title_kk')}}"
                 icon="pencil"
                 hint="{{__('table.title_kk')}}"
        />
    </div>
    {{--    Title in Kazakh --}}
    {{--    Title in English --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_en"
                 label="{{__('table.title_en')}}"
                 placeholder="{{__('table.title_en')}}"
                 icon="pencil"
                 hint="{{__('table.title_en')}}"
        />
    </div>
    {{--    Title in English --}}
    {{--    Tag --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="tag"
                 label="{{__('table.tag')}}"
                 placeholder="{{__('table.tag')}}"
                 icon="pencil"
                 hint="{{__('table.tag_hint')}}"
        />
    </div>
    {{--    Tag --}}
    {{-- Is Active --}}
    <x-checkbox
        id="is_active"
        label="{{__('table.is_active')}}*"
        icon="check"
        wire:model.defer="is_active"
    />
    {{-- Is Active --}}


</x-form-component.form-component>
