<div>

    <div class="w-full">
        <x-select
            label="{{__('table.subject_id')}}"
            wire:model="subject_id"
            placeholder="Выбрать предмет"
            :options="$subjects"
            option-label="title_ru"
            option-value="id"
            {{--            class="hover:bg-primary-500"--}}
        />
    </div>
    <livewire:math-type />
    <div class="md:flex lg:flex justify-between my-3">
        <div wire:ignore class="w-full">
            <x-ckeditor :input-name="'context'" :title="'Контекст ($$ @@)'"/>
        </div>
    </div>
</div>
