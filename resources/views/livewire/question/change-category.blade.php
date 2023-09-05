<div>
{{--    <x-select--}}
{{--        wire:model="category_id"--}}
{{--        placeholder="Выберите категорию предмета"--}}
{{--        :options="$categories"--}}
{{--        option-label="title_ru"--}}
{{--        option-value="id"--}}
{{--    />--}}

    <select wire:model="sub_category_id" class="form-control">
        <option value="0" selected>Выберите категорию</option>
        @foreach($categories as $category)
            <option disabled value="">
                <b>{{$category->title_ru}}</b>
            </option>
            @if(count($category->subcategories)>0)
                @foreach($category->subcategories as $item)
                    <option value="{{$item->id}}">-- {{\App\Helpers\StrHelper::getSubStr($item->title_ru, 45)}}</option>
                @endforeach
            @endif
        @endforeach
    </select>
</div>
