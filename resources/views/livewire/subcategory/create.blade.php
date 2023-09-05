<div>
    <div class="my-3">
        <x-select
            label="Выберите предмет"
            wire:model="subject_id"
            placeholder="Выберите предмет"
            :options="$subjects"
            option-label="title_ru"
            option-value="id"
            {{--            class="hover:bg-primary-500"--}}
        />
    </div>

    <div class="my-3">
        <x-select
            label="Выберите категорию"
            wire:model="category_id"
            placeholder="Выберите категорию"
            :options="$categories"
            option-label="title_ru"
            option-value="id"
            {{--            class="hover:bg-primary-500"--}}
        />
    </div>
    <div class="my-3">
        <x-input wire:model="title_kk" label="Наименование на каз" required/>
    </div>
    <div class="my-3">
        <x-input wire:model="title_ru" label="Наименование на рус" required/>
    </div>
    <div class="my-3">
        <livewire:image-upload />
    </div>

</div>
