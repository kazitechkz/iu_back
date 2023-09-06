<div>
    <livewire:math-type />
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
            label="Категория"
            wire:model="category_id"
            placeholder="Выберите категорию предмета"
            :options="$categories"
            option-label="title_ru"
            option-value="id"
            {{--            class="hover:bg-primary-500"--}}
        />
    </div>
    <div class="my-3">
        <x-select
            label="СубКатегория"
            wire:model="sub_category_id"
            placeholder="Выберите субкатегорию предмета"
            :options="$subcategories"
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
    <div class="my-3">
        <x-select
            label="Группа"
            wire:model="group_id"
            placeholder="Выбрать группу"
            :options="$groups"
            option-label="title_ru"
            option-value="id"
            {{--            class="hover:bg-primary-500"--}}
        />
    </div>

    <div wire:ignore class="md:flex lg:flex justify-between my-3">
        <x-ckeditor :description="$text" :input-name="'text'" :title="'Текст вопроса ($$ @@)'"/>
    </div>

    <div class="w-full">
        <x-select
            label="Контектсты"
            wire:model="context_id"
            placeholder="Выбрать контекст"
            :options="$contexts"
            option-label="title"
            option-description="context"
            option-value="id"
            {{--            class="hover:bg-primary-500"--}}
        />
    </div>

    <div class="md:flex lg:flex justify-between my-3">
        <div wire:ignore class="w-full">
            <x-ckeditor :description="$context" :input-name="'context'" :title="'Контекст ($$ @@)'"/>
        </div>
    </div>

    <div class="md:flex my-3 justify-between">
        <div class="w-full pr-2">
            <x-input wire:model="answer_a" label="Ответ А ($$ @@)" placeholder="a"/>
        </div>
        <div class="w-full pr-2">
            <x-input wire:model="answer_b" label="Ответ B ($$ @@)" placeholder="b"/>
        </div>
        <div class="w-full pr-2">
            <x-input wire:model="answer_c" label="Ответ C ($$ @@)" placeholder="c"/>
        </div>
        <div class="w-full">
            <x-input wire:model="answer_d" label="Ответ D ($$ @@)" placeholder="d"/>
        </div>
    </div>
    <div class="md:flex my-3 justify-between">
        <div class="w-full pr-2">
            <x-input wire:model="answer_e" label="Ответ E ($$ @@)" placeholder="e"/>
        </div>
        <div class="w-full pr-2">
            <x-input wire:model="answer_f" label="Ответ F ($$ @@)" placeholder="f"/>
        </div>
        <div class="w-full pr-2">
            <x-input wire:model="answer_g" label="Ответ G ($$ @@)" placeholder="g"/>
        </div>
        <div class="w-full">
            <x-input wire:model="answer_h" label="Ответ H ($$ @@)" placeholder="h"/>
        </div>
    </div>
    <div class="my-3">
        <x-select
            multiselect
            label="Правильный ответ"
            wire:model="correct_answers"
            :options="$listCorrectAnswers"
        />
    </div>
    <div wire:ignore class="md:flex lg:flex justify-between my-3">
        <x-ckeditor :description="$prompt" :input-name="'prompt'" :title="'Подсказка ($$ @@)'"/>
        <div class="px-2"></div>
        <x-ckeditor :description="$explanation" :input-name="'explanation'" :title="'Решение ($$ @@)'"/>
    </div>

</div>

