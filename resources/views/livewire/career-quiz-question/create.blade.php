<x-form-component.form-component
    :method="'post'"
    :route="'career-quiz-question.store'"
    :element-id="'career-quiz-question-create'"
>
    {{--    Quiz  --}}
    <div class="form-group">
        <x-select
            :label="__('table.quiz_id')"
            :options="$quizzes"
            :option-value="'id'"
            :option-label="'title_ru'"
            wire:model="quiz_id"
        />
    </div>
    {{--    Quiz--}}
    @if($quiz_id && $features != null)
        {{--    Feature  --}}
        <div class="form-group">
            <x-select
                :label="__('table.feature_id')"
                :options="$features"
                :option-value="'id'"
                :option-label="'title_ru'"
                wire:model="feature_id"
            />
        </div>
        {{--    Feature--}}
    @endif
    {{--    Question in Russian --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="question_ru"
                 label="{{__('table.question_ru')}}*"
                 placeholder="{{__('table.question_ru')}}"
                 icon="pencil"
                 hint="{{__('table.question_ru')}}"
        />
    </div>
    {{--    Question in Russian --}}
    {{--    Question in Kazakh --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="question_kk"
                 label="{{__('table.question_kk')}}*"
                 placeholder="{{__('table.question_kk')}}"
                 icon="pencil"
                 hint="{{__('table.question_kk')}}"
        />
    </div>
    {{--    Question in Kazakh --}}
    {{--    Question in English --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="question_en"
                 label="{{__('table.question_en')}}"
                 placeholder="{{__('table.question_en')}}"
                 icon="pencil"
                 hint="{{__('table.question_en')}}"
        />
    </div>
    {{--    Question in English --}}
    {{--    Context Ru --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$context_ru" :input-name="'context_ru'" :title="'Контекст (Ru)*'"/>
            </div>
        </div>
    </div>
    {{--    Context Ru --}}
    {{--    Context Kk --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$context_kk" :input-name="'context_kk'" :title="'Контекст (Kk)*'"/>
            </div>
        </div>
    </div>
    {{--    Context Kk --}}
    {{--    Context En --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$context_en" :input-name="'context_en'" :title="'Контекст (En)'"/>
            </div>
        </div>
    </div>
    {{--    Context En --}}
</x-form-component.form-component>
