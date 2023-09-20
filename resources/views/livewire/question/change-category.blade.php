<div>
{{--    <x-select--}}
{{--        wire:model="category_id"--}}
{{--        placeholder="Выберите категорию предмета"--}}
{{--        :options="$categories"--}}
{{--        option-label="title_ru"--}}
{{--        option-value="id"--}}
{{--    />--}}

    <select wire:model="sub_category_id" class="form-control">
        <option value="0" selected>{{__('table.select_category')}}</option>
        @foreach($categories as $category)
            <option disabled value="">
                <b>{{\App\Helpers\StrHelper::getSubStr($category->title, 45)}}</b>
            </option>
            @if(count($category->subcategories)>0)
                @foreach($category->subcategories as $item)
                    <option value="{{$item->id}}">-- {{\App\Helpers\StrHelper::getSubStr($item->title, 45)}}</option>
                @endforeach
            @endif
        @endforeach
    </select>
</div>
