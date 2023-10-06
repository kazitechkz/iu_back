<div>
{{--    <livewire:math-type />--}}
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
    @if($sub_step)
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
    @endif

    <div class="flex p-3 w-full">
        <div class="w-1/2 px-1">
            @foreach($questions as $question)
                <div
                    class="mb-3 inline-flex w-full items-center justify-content-between rounded-lg bg-neutral-50 px-6 py-2 text-base text-neutral-600"
                    role="alert">
                    {{$loop->iteration}}. {!! \App\Helpers\StrHelper::latexToHTML($question->text) !!}
                    <span wire:click="addQuestion({{$question->id}})"
                        class="cursor-pointer ml-2 inline-block whitespace-nowrap rounded-[0.27rem] bg-primary-100 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-bold leading-none text-primary-700"
                    >+</span>
                </div>
            @endforeach

        </div>
        <div class="w-1/2 px-1">
            @foreach($stepQuestions as $question)
                <div
                    class="mb-3 inline-flex w-full items-center justify-content-between rounded-lg bg-neutral-50 px-6 py-2 text-base text-neutral-600"
                    role="alert">
                    {{$loop->iteration}}. {!! \App\Helpers\StrHelper::latexToHTML($question->question->text) !!}
                    <span wire:click="removeQuestion({{$question->question->id}})"
                        class="cursor-pointer inline-block whitespace-nowrap rounded-[0.27rem] bg-primary-100 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-bold leading-none text-danger"
                    ><i class="fa fa-trash" aria-hidden="true"></i></span>
                </div>
            @endforeach

        </div>
    </div>
{{--    <div wire:ignore class="md:flex lg:flex justify-between my-3">--}}
{{--        <x-ckeditor :description="$this->text" :input-name="'text'" :title="'Текст вопроса ($$ @@)'"/>--}}
{{--    </div>--}}

{{--    <div class="w-full" id="context-img">--}}
{{--        <x-select--}}
{{--            label="Контексты"--}}
{{--            wire:model="context_id"--}}
{{--            placeholder="Выбрать контекст"--}}
{{--            :options="$contexts"--}}
{{--            option-label="contextWithCount"--}}
{{--            option-value="id"--}}
{{--            --}}{{--            class="hover:bg-primary-500"--}}
{{--        />--}}
{{--    </div>--}}

{{--    <div class="md:flex lg:flex justify-between my-3">--}}
{{--        <div wire:ignore class="w-full">--}}
{{--            <x-ckeditor :description="$context" :input-name="'context'" :title="'Контекст ($$ @@)'"/>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="md:flex my-3 justify-between">--}}
{{--        <div class="w-full pr-2">--}}
{{--            <x-input wire:model="answer_a" label="Ответ А ($$ @@)" placeholder="a"/>--}}
{{--        </div>--}}
{{--        <div class="w-full pr-2">--}}
{{--            <x-input wire:model="answer_b" label="Ответ B ($$ @@)" placeholder="b"/>--}}
{{--        </div>--}}
{{--        <div class="w-full pr-2">--}}
{{--            <x-input wire:model="answer_c" label="Ответ C ($$ @@)" placeholder="c"/>--}}
{{--        </div>--}}
{{--        <div class="w-full">--}}
{{--            <x-input wire:model="answer_d" label="Ответ D ($$ @@)" placeholder="d"/>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="my-3">--}}
{{--        <x-select--}}
{{--            label="Правильный ответ"--}}
{{--            wire:model="correct_answers"--}}
{{--            :options="$listCorrectAnswers"--}}
{{--        />--}}
{{--    </div>--}}
</div>
