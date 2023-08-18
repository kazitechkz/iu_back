<div>
    <div class="my-3">
        <x-select
            label="Предмет"
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
            label="Тип вопроса"
            wire:model="type_id"
            placeholder="Выберите тип"
            :options="$types"
            option-label="title_ru"
            option-value="id"
            {{--            class="hover:bg-primary-500"--}}
        />
    </div>
    <div class="my-3">
        <x-select
            label="Язык"
            wire:model="locale_id"
            placeholder="Выбрать язык"
            :options="$locales"
            option-label="title"
            option-value="id"
            {{--            class="hover:bg-primary-500"--}}
        />
    </div>
</div>
