<x-form-component.form-component
    :method="'put'"
    :parameters="['career_quiz_answer'=>$careerQuizAnswer]"
    :route="'career-quiz-answer.update'"
    :element-id="'career-quiz-answer-edit'"
>
    {{--    Quiz  --}}
    <div class="form-group">
        <x-select
            :label="__('table.quiz_id')"
            :options="$quizzes"
            :option-value="'id'"
            :option-label="'title_ru'"
            wire:model.defer="quiz_id"
        />
    </div>
    {{--    Quiz--}}
    {{--    Title in Russian --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_ru"
                 label="{{__('table.title_ru')}}*"
                 placeholder="{{__('table.title_ru')}}"
                 icon="pencil"
                 hint="{{__('table.title_ru')}}"
        />
    </div>
    {{--    Title in Russian --}}
    {{--    Title in Kazakh --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_kk"
                 label="{{__('table.title_kk')}}*"
                 placeholder="{{__('table.title_kk')}}"
                 icon="pencil"
                 hint="{{__('table.title_kk')}}"
        />
    </div>
    {{--    Title in Kazakh --}}
    {{--    Title in English --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_en"
                 label="{{__('table.title_en')}}"
                 placeholder="{{__('table.title_en')}}"
                 icon="pencil"
                 hint="{{__('table.title_en')}}"
        />
    </div>
    {{--    Title in English --}}
    {{-- Value --}}
    <div class="form-group">
        <x-inputs.number
            label="{{__('table.value')}}*"
            prefix="0"
            wire:model="value"
            hint="{{__('table.value')}}"
        />
    </div>
    {{-- Value --}}
</x-form-component.form-component>
