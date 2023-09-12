<div>
    <div class="form-group">
        <x-input icon="search"
                 wire:model="search"
                 wire:keyup="search_user"
                 right-icon="search"
                 label="{{__('table.search')}}"
                 placeholder="{{__('table.search_user')}}"
                 hint="{{__('table.search_user')}}"
        />
        @if($loading)
            <div role="status">
                <svg aria-hidden="true" class="inline w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-pink-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
        @else
            @if($users)
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400" for="user_result">{{__("table.user_id")}}</label>
                    <select wire:model="user_id" name="user_id" class="form-control" id="user_result">
                        <option value="">{{__("table.user_id")}}</option>
                        @foreach($users as $userItem)
                            @if(is_object($userItem))
                                @if(in_array($userItem->searchable->id,$roles))
                                    <option
                                        class="py-2 px-3 focus:outline-none all-colors ease-in-out duration-150 relative group text-secondary-600 dark:text-secondary-400 flex items-center justify-between cursor-pointer focus:bg-primary-100 focus:text-primary-800 hover:text-white dark:focus:bg-secondary-700 hover:bg-primary-500 dark:hover:bg-secondary-700"
                                        value="{{$userItem->searchable->id}}">
                                        {{$userItem->searchable->name}}
                                        ({{$userItem->searchable->email}})
                                    </option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>
            @endif
        @endif


            {{--    User Email--}}
            <div class="form-group">
                <x-input
                    type="email"
                    class="my-2"
                    wire:model="email"
                    label="{{__('table.email')}}*"
                    placeholder="{{__('table.email_placeholder')}}"
                    icon="mail"
                    hint="{{__('table.email_hint')}}"
                />
            </div>
            {{--    User Email--}}
            {{--    User Phone--}}
            <div class="form-group">
                <x-inputs.phone
                    label="{{__('table.phone')}}*"
                    placeholder="{{__('table.phone_placeholder')}}"
                    hint="{{__('table.phone_hint')}}"
                    wire:model="phone"
                    icon="phone"
                />
            </div>
            {{--    User Phone--}}
            {{--    Gender--}}
            <div class="form-group">
                <x-select
                    label="{{__('table.gender_id')}}*"
                    placeholder="{{__('table.gender_id')}}"
                    :options="$genders"
                    :option-label="'title_ru'"
                    :option-value="'id'"
                    wire:model="gender_id"
                    name="gender_id"
                />
            </div>
            {{--   Gender--}}
            {{--    Bio --}}
            <div class="form-group">
                <x-textarea
                    wire:model="bio"
                    label="{{__('table.bio')}}*"
                    placeholder="{{__('table.bio')}}"
                    hint="{{__('table.bio')}}"
                />
            </div>
            {{--    Bio --}}
            {{--    Experience --}}
            <div class="form-group">
                <x-textarea
                    wire:model="experience"
                    label="{{__('table.experience')}}*"
                    placeholder="{{__('table.experience')}}"
                    hint="{{__('table.experience')}}"
                />
            </div>
            {{--    Experience --}}
        {{--    Birth Date --}}
        <div class="form-group">
            <x-datetime-picker
                label="{{__('table.birth_date')}}"
                placeholder="{{__('table.birth_date')}}"
                :without-time="true"
                parse-format="DD-MM-YYYY"
                wire:model.defer="birth_date"

            />
        </div>
        {{--    Birth Date --}}
        {{--   Subject --}}
            <div class="form-group">
                <x-select
                    label="{{__('table.subject_id')}}"
                    placeholder="{{__('table.subject_id')}}"
                    multiselect
                    :options="$subjects"
                    option-value="id"
                    option-label="title"
                    wire:model="subject_id"
                />
            </div>
        {{--   Subject --}}
        {{--   Category --}}
        <div class="form-group">
            <x-select
                label="{{__('table.category_id')}}"
                placeholder="{{__('table.category_id')}}"
                multiselect
                :options="$categories"
                option-value="id"
                option-label="title"
                wire:model="category_id"
            />
        </div>
        {{--   Category --}}
            {{-- Is Proved --}}
        <div class="form-group">
            <x-checkbox
                id="is_proved"
                label="{{__('table.is_proved')}}"
                icon="check"
                wire:model.defer="is_proved"
            />
        </div>
            {{-- Is Proved --}}





    </div>
</div>
