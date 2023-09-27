<div>
    <div class="my-3 flex">
        <x-select
            label="Предмет"
            wire:model="subject_id"
            placeholder="Выберите предмет"
            :options="$subjects"
            option-label="title"
            option-value="id"
            {{--            class="hover:bg-primary-500"--}}
        />
        <div class="mx-2"></div>
        <x-select
            label="Язык"
            wire:model="locale_id"
            placeholder="Выберите язык"
            :options="$locales"
            option-label="title"
            option-value="id"
            {{--            class="hover:bg-primary-500"--}}
        />

    </div>
    <x-loading-indicator />
    @if($show)
        <div
            class="my-3 flex flex-col rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 md:flex-row">
            <div class="w-[30%] p-5 flex justify-center items-center">
                <strong>Категория</strong>
            </div>

            <div class="flex flex-col justify-start p-6 w-full">
                <div class="flex">
                    <div class="w-[60%] p-5 break-all">
                        <strong>Субкатегория</strong>
                    </div>
                    <div class="w-[20%] p-3 break-all flex justify-start items-center">

                        {{$questions->count()}}<span class="mx-2">/</span>
                        <span
                            class="text-red-600">{{$questions->where('sub_category_id', null)->count()}}</span>
                        <span class="mx-2">/</span>
                        <span
                            class="text-green-600">{{$questions->where('sub_category_id', !null)->count()}}</span>
                    </div>
                    <div class="w-[20%] p-3 break-all flex justify-start items-center">
                        One / Context / Multi
                    </div>
                </div>
            </div>
        </div>
        <div class="my-3">
            @if($categories)
                @foreach($categories as $category)
                    <div
                        class="my-3 flex flex-col rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 md:flex-row">
                        <div class="w-[30%] p-5 flex">
                            <span>{{$loop->iteration}}.</span>
                            <span class="break-all ml-2">{{$category->title}}</span>
                        </div>

                        <div class="flex flex-col justify-start p-6 w-full">
                            @if($category->subcategories)
                                @foreach($category->subcategories as $item)
                                    <div class="flex">
                                        <div class="w-[60%] p-3 break-all">
                                            {{$item->title}}
                                        </div>
                                        <div class="w-[20%] p-3 break-all flex">
                                            @if($item->questions->where('locale_id', $locale_id)->count() >= 20)
                                                <span class="text-green-500">{{$item->questions->where('locale_id', $locale_id)->count()}}</span>
                                            @elseif($item->questions->count() > 0)
                                                <span class="text-yellow-500">{{$item->questions->where('locale_id', $locale_id)->count()}}</span>
                                            @else
                                                <span class="text-red-500">{{$item->questions->where('locale_id', $locale_id)->count()}}</span>
                                            @endif
                                        </div>
                                        <div class="w-[20%] p-3 break-all flex">
                                            {{$item->questions->where('locale_id', $locale_id)->where('type_id', \App\Services\QuestionService::SINGLE_QUESTION_ID)->count()}}
                                            <span class="mx-2">/</span>
                                            {{$item->questions->where('locale_id', $locale_id)->where('type_id', \App\Services\QuestionService::CONTEXT_QUESTION_ID)->count()}}
                                            <span class="mx-2">/</span>
                                            {{$item->questions->where('locale_id', $locale_id)->where('type_id', \App\Services\QuestionService::MULTI_QUESTION_ID)->count()}}
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    @endif

</div>


{{--<div class="flex flex-col">--}}
{{--    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">--}}
{{--        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">--}}
{{--            <div class="overflow-hidden">--}}
{{--                <table class="min-w-full text-left text-sm font-light">--}}
{{--                    <thead class="border font-medium dark:border-neutral-500">--}}
{{--                    <tr>--}}
{{--                        <th scope="col" class="px-6 py-4">#</th>--}}
{{--                        <th scope="col" class="px-6 py-4">Категория</th>--}}
{{--                        <th scope="col" class="px-6 py-4">Субкатегория</th>--}}
{{--                        <th scope="col" class="px-6 py-4">Количество вопросов</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @if($categories)--}}
{{--                        @foreach($categories as $category)--}}
{{--                            <tr--}}
{{--                                class="border transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600">--}}
{{--                                <th class="border whitespace-nowrap px-6 py-4 font-medium"--}}
{{--                                    rowspan="{{count($category->subcategories) + 1}}">{{$loop->iteration}}</th>--}}
{{--                                <th style="width: 300px;" class="border whitespace-nowrap px-6 py-4"--}}
{{--                                    rowspan="{{count($category->subcategories) + 1}}">--}}
{{--                                    <div style="width: 300px; height: 300px">--}}
{{--                                        {!! \App\Helpers\StrHelper::getSubStr($category->title, 30) !!}--}}
{{--                                    </div>--}}
{{--                                </th>--}}
{{--                            @if($category->subcategories)--}}
{{--                                @foreach($category->subcategories as $item)--}}
{{--                                    <tr>--}}
{{--                                        <td width="50%" class="border whitespace-nowrap px-6 py-4">{{$item->title}}</td>--}}
{{--                                        <td width="20%" class="border whitespace-nowrap px-6 py-4">123</td>--}}
{{--                                    </tr>--}}
{{--                                    @endforeach--}}
{{--                                    @endif--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
