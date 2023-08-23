<div>
    <x-select
        wire:model="category_id"
        placeholder="Выберите категорию предмета"
        :options="$categories"
        option-label="title_ru"
        option-value="id"
        {{--            class="hover:bg-primary-500"--}}
    />
</div>
