<x-form-component.form-component
    :method="'put'"
    :route="'tournament-prize.update'"
    :parameters="['tournament_prize'=>$tournamentPrize]"
    :element-id="'tournament-prize-edit'"
>
    {{--    Tournament  --}}
    <div class="form-group">
        <x-select
            label="{{__('table.tournament_id')}}*"
            :options="$tournaments"
            option-label="title_ru"
            option-value="id"
            wire:model="tournament_id"
            name="tournament_id"
        />
    </div>
    {{--    Tournament--}}
    {{--    Title Ru --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_ru"
                 label="{{__('table.title_ru')}}*"
                 placeholder="{{__('table.title_ru')}}"
                 icon="pencil"
                 hint="{{__('table.title_ru')}}"
        />
    </div>
    {{--    Title Ru--}}
    {{--    Title Kk --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_kk"
                 label="{{__('table.title_kk')}}*"
                 placeholder="{{__('table.title_kk')}}"
                 icon="pencil"
                 hint="{{__('table.title_kk')}}"
        />
    </div>
    {{--    Title Kk--}}
    {{--    Title En --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_en"
                 label="{{__('table.title_en')}}"
                 placeholder="{{__('table.title_en')}}"
                 icon="pencil"
                 hint="{{__('table.title_en')}}"
        />
    </div>
    {{--    Title En--}}
    {{-- Order --}}
    <div class="form-group">
        <x-inputs.number
            label="Номер"
            wire:model="order"
            hint="(необязателен если массово,1 место, 2 место)"
        />
    </div>
    {{-- Order --}}
    {{-- Start From --}}
    <div class="form-group">
        <x-inputs.number
            label="C"
            wire:model="start_from"
            hint="Начиная с (необязателен если указан номер)"
        />
    </div>
    {{-- Start From --}}
    {{-- End To --}}
    <div class="form-group">
        <x-inputs.number
            label="C"
            wire:model="end_to"
            hint="До  (необязателен если указан номер)"
        />
    </div>
    {{-- End To --}}
    {{-- Value --}}
    <div class="form-group">
        <x-inputs.number
            label="Значение"
            wire:model="value"
            hint="(значение если виртуально)"
        />
    </div>
    {{-- Value --}}
    {{-- Is Virtual --}}
    <div class="form-group">
        <x-checkbox
            id="is_virtual"
            label="Виртуальная награда"
            icon="check"
            wire:model.defer="is_virtual"
            hint="Если награда IU Coins"
        />
    </div>
    {{-- Is Virtual --}}
</x-form-component.form-component>
