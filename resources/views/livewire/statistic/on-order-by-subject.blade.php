<div>
    <input type="date" wire:model="date" class="form-control my-3">
    <div class="table-responsive" wire:poll>
        <table class="table table-bordered table-sm">
            <tbody>
            <tr>
                <td >
                    <p ><span class="font-weight-bold">№</span></p>
                </td>
                <td >
                    <p ><span class="font-weight-bold">Предметы</span></p>
                </td>
                <td >
                    <p ><span class="font-weight-bold">Количество подписок</span></p>
                </td>
                <td >
                    <p ><span class="font-weight-bold">Действие</span></p>
                </td>
            </tr>
            @foreach($allOrders as $order)
                <tr>
                    <td >
                        <p class="font-weight-bold">{{$loop->iteration}}</p>
                    </td>
                    <td >
                        <p class="font-weight-bold">
                            {{$order['title']}}</p>
                    </td>
                    <td >
                        <p ><span>{{$order['count']}}</span></p>
                    </td>
                    <td >
                        <a class="cursor-pointer" wire:click="getInfo({{$order['id']}})">
                            <span>Посмотреть</span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @if($isInfoShow)
        <div class="py-5" wire:poll>
            <div class="py-3">
                <div class="w-full lg:flex">
                    <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('https://iunion.s3.ap-south-1.amazonaws.com/{{$subjectImg}}')" title="Woman holding a mug">
                    </div>
                    <div class="w-full border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                        <div class="mb-8">
                            <h2>{{$this->subjectTitle}}
                                <span>({{$date}})</span>
                            </h2>
                            <p class="my-2">Количество подписок: <b>{{$this->countOrders}}</b></p>
                            <p class="my-2">Общее поступление: <b>{{$this->priceOrders}} тг</b></p>
                            <p class="my-2">Доля Грант + (20%): <b>{{$this->grantPrice}} тг</b></p>
                            <p class="my-2">Процентное соотношение предмета: <b>{{$this->percentage}} % </b></p>
                            <p class="my-2">Заработок предмета: <b>{{$this->cash}} тг </b></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-2">
                <table class="min-w-full bg-white shadow-md rounded-xl">
                    <thead>
                    <tr class="bg-blue-gray-100 text-gray-700">
                        <th class="py-3 px-4 text-left">№</th>
                        <th class="py-3 px-4 text-left">Имя ученика</th>
                        <th class="py-3 px-4 text-left">Тариф</th>
                        <th class="py-3 px-4 text-left">Цена</th>
                        <th class="py-3 px-4 text-left">Дата покупки</th>
                    </tr>
                    </thead>
                    <tbody class="text-blue-gray-900">
                    @foreach($orders as $order)
                        <tr class="border-b border-blue-gray-200">
                            <td class="py-3 px-4">{{$loop->iteration}}</td>
                            <td class="py-3 px-4">{{$order->user->name}}</td>
                            <td class="py-3 px-4">{{$this->getPlanTitle($order->plans[0])}}</td>
                            <td class="py-3 px-4">{{$order->price}} тг</td>
                            <td class="py-3 px-4">
                                {{$order->created_at->format('d.m.y')}}<span class="mx-2"><small>({{$order->created_at->diffForHumans()}})</small></span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-2 text-end">
                    @if($this->countOrders > $this->perPage)
                        <button class="text-blue-500 cursor-pointer" wire:click.prevent="loadMore">Загрузить еще</button>
                    @endif
                </div>
            </div>
        </div>
    @endif

</div>
