<x-form-component.form-component
    :method="'put'"
    :route="'user.update'"
    :parameters="['user'=>$user]"
    :element-id="'user-create'"
>
    <div class="form-group">
        <x-input class="my-2"
                 type="hidden"
                 wire:model="user_id"
                 value="{{$user->id}}"
        />
    </div>
    {{--    User Name--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="name"
                 label="{{__('table.user_name')}}*"
                 placeholder="{{__('table.user_name_hint')}}"
                 icon="user"
                 hint="{{__('table.user_name')}}"
        />
    </div>
    {{--    User Name--}}
    {{--    NickName--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="username "
                 label="{{__('table.username')}}*"
                 placeholder="UserName"
                 icon="user"
                 hint="{{__('table.username_hint')}}"
        />
    </div>
    {{--    NickName--}}
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
    {{--    User Password--}}
    <div class="form-group">
        <x-inputs.password
            label="{{__('table.password')}}"
            wire:model="password"
            icon="lock-closed"
            hint="{{__('table.password_hint')}}"

        />
    </div>
    {{--    User Password--}}
    {{--    User Phone--}}
    <div class="form-group">
        <x-inputs.phone
            label="{{__('table.phone')}}*"
            hint="{{__('table.phone_hint')}}"
            placeholder="{{__('table.phone_placeholder')}}"
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
    {{--    Birth Date --}}
    <div class="form-group">
            <x-datepicker
                label="{{__('table.birth_date')}}" wire:model="birth_date"
                :config="['altFormat' => 'd.m.Y','enableTime'=>false,'time_24hr'=>true]"
                name="birth_date"
                class="placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm pl-8 my-2" />
    </div>
    {{--    Birth Date --}}
    {{-- Image Url --}}
    <label class="h-5">{{__('table.image_url')}}*</label>
    <livewire:image-upload :file="$image_url" :folder-name="'avatars'" :id="$user->image_url != null ? $user->image_url : 0"/>
    {{-- Image Url --}}
    {{--    User Role--}}

    <div class="form-group">
            <label class="h-5 font-weight-bold text-gray-700" for="role_id">{{__('table.role_id')}}</label>
            <select name="role" class="form-control focus:outline-none shadow-sm text-dark" id="role_id" wire:model="role">
                @if(count($roles) > 0)
                    @foreach($roles as $role)
                        <option
                            value="{{$role["name"]}}"
                            >
                            {{$role["name"]}} {{$user->hasRole($role["name"]) == true ? "*" :""}}
                        </option>
                    @endforeach
                @endif
            </select>
    </div>
    {{--    User Role--}}
</x-form-component.form-component>
