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
        <x-native-select
            wire:change="toggleQuestionType"
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


    <div class="md:flex my-3 justify-between">
        <div class="w-full pr-2">
            <x-input wire:model="answer_a" label="Ответ А" placeholder="a"/>
        </div>
        <div class="w-full pr-2">
            <x-input wire:model="answer_b" label="Ответ B" placeholder="b"/>
        </div>
        <div class="w-full pr-2">
            <x-input wire:model="answer_c" label="Ответ C" placeholder="c"/>
        </div>
        <div class="w-full">
            <x-input wire:model="answer_d" label="Ответ D" placeholder="d"/>
        </div>
    </div>
    <div class="md:flex my-3 justify-between">
        <div class="@if($showAnswersInput) w-full @else w-25 @endif pr-2">
            <x-input wire:model="answer_e" label="Ответ E" placeholder="e"/>
        </div>
        @if($showAnswersInput)
            <div class="w-full pr-2">
                <x-input wire:model="answer_f" label="Ответ F" placeholder="f"/>
            </div>
            <div class="w-full pr-2">
                <x-input wire:model="answer_g" label="Ответ G" placeholder="g"/>
            </div>
            <div class="w-full">
                <x-input wire:model="answer_h" label="Ответ H" placeholder="h"/>
            </div>
        @endif

    </div>





</div>
