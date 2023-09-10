<x-form-component.form-component
    :method="'post'"
    :route="'group.store'"
    :element-id="'group-create'"
>

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
                 label="{{__('table.title_en')}}*"
                 placeholder="{{__('table.title_en')}}"
                 icon="pencil"
                 hint="{{__('table.title_en')}}"
        />
    </div>
    {{--    Title in English --}}

    {{-- Is Active --}}
    <x-checkbox
        id="is_active"
        label="{{__('table.is_active')}}"
        icon="check"
        wire:model.defer="isActive"
    />
    {{-- Is Active --}}
    {{-- Plans --}}
    <p class="h-3 mb-3 font-weight-bold">
        {{__('table.plan_id')}}:
    </p>
    <div class="form-group">
        @foreach($plans as $plan)
            <x-checkbox
                value="{{$plan->id}}"
                id="{{$plan->id}}"
                name="planGroups[]"
                multiple="multiple"
                selected
                label="{{$plan->name}}"
            />
        @endforeach
    </div>
    {{-- Plans --}}


</x-form-component.form-component>
