<x-form-component.form-component
    :method="'put'"
    :route="'tutor.update'"
    :parameters="['tutor'=>$tutor]"
    :element-id="'tutor-update'"
>
    <div>
        <div class="form-group">
            <x-input class="my-2"
                     type="hidden"
                     wire:model="tutor_id"
                     value="{{$tutor->id}}"
            />
        </div>
  {{--    IIN  --}}
                <div class="form-group">
                    <x-input
                        type="iin"
                        class="my-2"
                        wire:model="iin"
                        label="{{__('table.iin')}}*"
                        placeholder="{{__('table.iin')}}"
                        icon="user"
                        hint="{{__('table.iin_hint')}}"
                    />
                </div>
                {{--    IIN--}}
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
</x-form-component.form-component>
