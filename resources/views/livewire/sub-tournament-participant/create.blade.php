<x-form-component.form-component
    :method="'post'"
    :route="'sub-tournament-participant.store'"
    :element-id="'sub-tournament-participant-create'"
>
    {{--    Tournaments  --}}
    <div class="form-group">
        <x-select
            :label="'Турнир'"
            :options="$tournaments"
            :option-value="'id'"
            :option-label="'title_ru'"
            wire:model="tournament_id"
        />
    </div>
    {{--    Tournaments  --}}
    {{--    SubTournament  --}}
    <div class="form-group">
        <x-select
            :label="'Этап'"
            :options="$steps"
            :option-value="'id'"
            :option-label="'title_ru'"
            wire:model="step_id"
        />
        <input hidden type="text" name="sub_tournament_id" wire:model="sub_tournament_id">
    </div>
    {{--    SubTournament  --}}

    {{--    User Search --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="user_search"
                 label="{{__('table.search_user')}}*"
                 icon="user"
                 hint="{{__('table.search_user')}}"
        />
    </div>
    <div class="form-group flex justify-center">
        <a class="btn btn-info text-white font-bold" wire:click="findUser">
            Поиск пользователя
        </a>
    </div>
    {{--    User Search --}}
    {{--    Users--}}
    <div class="form-group">
        <x-select
            :label="__('table.user')"
            :options="$users"
            :option-value="'id'"
            :option-label="'name'"
            :option-description="'email'"
            wire:model="user_id"
        />
    </div>
    {{-- Users --}}

</x-form-component.form-component>
