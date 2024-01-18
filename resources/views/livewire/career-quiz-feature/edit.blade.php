<x-form-component.form-component
    :method="'put'"
    :parameters="['career_quiz_feature'=>$careerQuizFeature]"
    :route="'career-quiz-feature.update'"
    :element-id="'career-quiz-feature-update'"
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

    {{-- Image Url --}}
    <label class="h-5">{{__('table.image_url')}}*</label>
    <livewire:image-upload :id="$image_url" :folder-name="'career_author'"/>
    {{-- Image Url --}}
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
    {{--    Description Ru --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$description_ru" :input-name="'description_ru'" :title="'Описание (Ru)*'"/>
            </div>
        </div>
    </div>
    {{--    Description Ru --}}
    {{--    Description Kk --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$description_kk" :input-name="'description_kk'" :title="'Описание (Kk)*'"/>
            </div>
        </div>
    </div>
    {{--    Description Kk --}}
    {{--    Description En --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$description_en" :input-name="'description_en'" :title="'Описание (En)'"/>
            </div>
        </div>
    </div>
    {{--    Description En --}}
    {{--    Activity Ru --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$activity_ru" :input-name="'activity_ru'" :title="'Направление (Ru)*'"/>
            </div>
        </div>
    </div>
    {{--    Activity Ru --}}
    {{--    Activity Kk --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$activity_kk" :input-name="'activity_kk'" :title="'Направление (Kk)*'"/>
            </div>
        </div>
    </div>
    {{--    Activity Kk --}}
    {{--    Activity En --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$activity_en" :input-name="'activity_en'" :title="'Направление (En)'"/>
            </div>
        </div>
    </div>
    {{--    Activity En --}}
    {{--    Prospect Ru --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$prospect_ru" :input-name="'prospect_ru'" :title="'Перспектива (Ru)*'"/>
            </div>
        </div>
    </div>
    {{--    Prospect Ru --}}
    {{--    Prospect Kk --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$prospect_kk" :input-name="'prospect_kk'"
                            :title="'Перспектива (Kk)*'"/>
            </div>
        </div>
    </div>
    {{--    Prospect Kk --}}
    {{--    Prospect En --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$prospect_en" :input-name="'prospect_en'"
                            :title="'Перспектива (En)'"/>
            </div>
        </div>
    </div>
    {{--    Prospect En --}}
    {{--    Meaning Ru --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$meaning_ru" :input-name="'meaning_ru'"
                            :title="'Значение (Ru)*'"/>
            </div>
        </div>
    </div>

    {{--    Meaning Ru --}}
    {{--    Meaning Kk --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$meaning_kk" :input-name="'meaning_kk'"
                            :title="'Значение (Kk)*'"/>
            </div>
        </div>
    </div>
    {{--    Meaning Kk --}}
    {{--    Meaning En --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$meaning_en" :input-name="'meaning_en'"
                            :title="'Значение (En)'"/>
            </div>
        </div>
    </div>
    {{--    Meaning En --}}
</x-form-component.form-component>
