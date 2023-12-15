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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($this->stats as $stat)
                            <tr class="border-b dark:border-neutral-500">
                                <td class="whitespace-nowrap px-6 py-4">{{$stat->name}}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{$stat->stats_by_questions ? $stat->stats_by_questions->count() : 0}}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{$stat->stats_by_contents ? $stat->stats_by_contents->count() : 0}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
