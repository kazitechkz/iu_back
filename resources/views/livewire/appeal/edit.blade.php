<x-form-component.form-component
    :method="'put'"
    :route="'appeal.update'"
    :parameters="['appeal'=>$appeal]"
    :element-id="'appeal-update'"
>

    {{--    Search Question --}}
    @if($questions)
        <div class="form-group">
            <div class="flex justify-between items-end mb-1">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400" for="78e731027d8fd50ed642340b7c9a63b3">
                    {{__('table.question')}}*
                </label>
            </div>
            <select name="question_id" wire:model="question_id" class="placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm pl-8 my-2" >
                @foreach($questions as $questionItem)
                    @if(is_object($questionItem))
                        <option value="{{$questionItem->id}}">
                            {{$questionItem->text}}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
    @endif
    {{--    Search Question --}}

    {{--    Appeal Types --}}
    <div class="form-group">
        <x-select
            label="Appeal Types*"
            :options="$appeal_types"
            option-label="title_ru"
            option-value="id"
            wire:model="type_id"
            name="type_id"
        />
    </div>
    {{--    Appeal Types --}}

    {{--    Message --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="message"
                 label=" {{__('table.message')}}*"
                 placeholder=" {{__('table.message')}}"
                 icon="pencil"
                 hint=" {{__('table.message')}}"
        />
    </div>
    {{--    Message --}}
    {{--    Statuses --}}
    <div class="form-group">
        <x-select
            label=" {{__('table.status')}}*"
            :options="$statuses"
            option-label="name"
            option-value="id"
            wire:model="status"
            name="status"
        />
    </div>
    {{--    Statuses --}}


</x-form-component.form-component>

