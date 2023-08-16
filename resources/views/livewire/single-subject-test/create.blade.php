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
        <x-input min="0" type="number" wire:model="single_answer_questions_quantity" label="Кол-во вопросов с 1 ответом" required/>
    </div>
    <div class="my-3">
        <x-input min="0" type="number" wire:model="contextual_questions_quantity" label="Кол-во контекстных вопросов" required/>
    </div>
    <div class="my-3">
        <x-input min="0" type="number" wire:model="multi_answer_questions_quantity" label="Кол-во вопросов с несколькими ответами" required/>
    </div>
    <div class="my-3">
        <x-input min="0" value="60" type="number" wire:model="allotted_time" label="Отведенное время (мин)" required/>
    </div>
</div>
