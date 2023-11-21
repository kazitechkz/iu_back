<x-form-component.form-component
    :method="'put'"
    :route="'notification.update'"
    :parameters="['notification'=>$notification]"
    :element-id="'notification-update'"
>
    {{--    Type --}}
    <div class="form-group">
        <x-select
            label="{{__('table.type_id')}}*"
            :options="$types"
            option-label="title_ru"
            option-value="id"
            wire:model="type_id"
            name="type_id"
        />
    </div>
    {{--    Type--}}
    {{--    Title --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title"
                 label="{{__('table.title')}}*"
                 placeholder="{{__('table.title')}}"
                 icon="pencil"
                 hint="{{__('table.title')}}"
        />
    </div>
    {{--    Title--}}
    {{--    Message--}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$message" :input-name="'message'" :title="'Описание'"/>
            </div>
        </div>
    </div>
    {{--    Message --}}


</x-form-component.form-component>

