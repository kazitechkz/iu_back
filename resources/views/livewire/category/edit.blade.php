<div>
    <div class="my-3">
        <x-select
            label="Выберите предмет"
            wire:model="subject_id"
            placeholder="Выберите предмет"
            :options="$subjects"
            option-label="title"
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
</div>
