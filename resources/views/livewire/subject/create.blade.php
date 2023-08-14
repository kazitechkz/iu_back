<div>
    <div class="my-3">
        <x-input wire:model="title_kk" label="Наименование на каз" placeholder="Наименование на каз" />
    </div>
    <div class="my-3">
        <x-input wire:model="title_ru" label="Наименование на рус" placeholder="Наименование на рус" />
    </div>
    <div class="my-3">
        <x-input type="number" wire:model="max_questions_quantity" label="Макс. кол-во вопросов" placeholder="максимальное количество вопросов" />
    </div>
    <div class="my-3">
        <x-checkbox wire:model.defer="is_compulsory" id="right-label" label="Этот предмет объязательный" />
    </div>
</div>
