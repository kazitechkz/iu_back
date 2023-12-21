<div>
    <div class="flex">
        <input type="date" class="form-control mx-2" wire:model="date">
        <select class="form-control mx-2" wire:model="time">
            <option value="1">За все время</option>
            <option value="2">За сегодня</option>
            <option value="3">За неделю</option>
            <option value="4">За месяц</option>
        </select>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                        <tr>
                            <th scope="col" class="px-6 py-4">Имя</th>
                            <th scope="col" class="px-6 py-4">Тесты</th>
                            <th scope="col" class="px-6 py-4">Конспекты</th>
                            <th scope="col" class="px-6 py-4">Переводы</th>
                            <th scope="col" class="px-6 py-4">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($this->data as $name => $stat)
                            <tr class="border-b dark:border-neutral-500">
                                <td class="whitespace-nowrap px-6 py-4">{{$name}}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{$stat['questions_kk']}}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{$stat['contents']}}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{$stat['questions_ru']}}</td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <a class="btn mx-1 border-black hover:border-red-600 bg-transparent rounded-full inline justify-center items-center" href="{{route('stats-on-user-tests', $stat['id'])}}">T</a>
                                    <a class="btn mx-1 border-black hover:border-red-600 bg-transparent rounded-full inline justify-center items-center" href="{{route('stats-on-user-contents', $stat['id'])}}">K</a>
                                    <a class="btn mx-1 border-black hover:border-red-600 bg-transparent rounded-full inline justify-center items-center" href="{{route('stats-on-user-translates', $stat['id'])}}">П</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="my-3 grid sm:grid-cols-1 sm:gap-1 lg:grid-cols-3 lg:gap-3">
        <div style="height: 32rem;">
            <livewire:livewire-column-chart key="{{ $questionsChart->reactiveKey() }}" :column-chart-model="$questionsChart"/>
        </div>
        <div style="height: 32rem;">
            <livewire:livewire-column-chart key="{{ $contentsChart->reactiveKey() }}" :column-chart-model="$contentsChart"/>
        </div>
        <div style="height: 32rem;">
            <livewire:livewire-column-chart key="{{ $translationChart->reactiveKey() }}" :column-chart-model="$translationChart"/>
        </div>
    </div>

</div>
