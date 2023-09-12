<div>
    <livewire:math-type />
    <div class="my-3">
        <x-select
            label="Предмет"
            wire:model="subject_id"
            placeholder="Выберите предмет"
            :options="$subjects"
            option-label="title"
            option-value="id"
        />
    </div>
    <div class="my-3">
        <x-select
            label="Раздел"
            wire:model="step_id"
            placeholder="Выберите раздел"
            :options="$steps"
            option-label="title"
            option-value="id"
        />
    </div>
    <div class="my-3">
        <x-select
            label="Подраздел"
            wire:model="sub_step_id"
            placeholder="Выберите подраздел"
            :options="$sub_steps"
            option-label="title"
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

    <div class="w-full" id="context-img">
        <x-select
            label="Контексты"
            wire:model="context_id"
            placeholder="Выбрать контекст"
            :options="$contexts"
            option-label="contextWithCount"
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
    <div class="my-3">
        <x-select
            label="Правильный ответ"
            wire:model="correct_answers"
            :options="$listCorrectAnswers"
        />
    </div>
</div>
