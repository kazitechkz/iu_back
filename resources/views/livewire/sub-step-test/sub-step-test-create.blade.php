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
        />
    </div>
    <div class="my-3">
        <x-select
            label="Раздел"
            wire:model="step_id"
            placeholder="Выберите раздел"
            :options="$steps"
            option-label="title_ru"
            option-value="id"
        />
    </div>
    <div class="my-3">
        <x-select
            label="Подраздел"
            wire:model="sub_step_id"
            placeholder="Выберите подраздел"
            :options="$sub_steps"
            option-label="title_ru"
            option-value="id"
        />
    </div>
    <div class="my-3">
        <x-select
            label="Язык"
            wire:model="locale_id"
            placeholder="Выберите язык"
            :options="$locales"
            option-label="title"
            option-value="id"
        />
    </div>

    <div wire:ignore class="md:flex lg:flex justify-between my-3">
        <x-ckeditor :description="$this->text" :input-name="'text'" :title="'Текст вопроса ($$ @@)'"/>
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
    <div class="my-3">
        <x-select
            label="Правильный ответ"
            wire:model="correct_answer"
            :options="$listCorrectAnswers"
        />
    </div>
</div>
