<div class="py-3">
    <div class="w-full lg:flex">
        <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url({{asset('images/cash.png')}})" title="Woman holding a mug">
        </div>
        <div class="w-full border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
            <div class="mb-8">
                <h2>Общее поступление за все время</h2>
                <p class="my-2">Количество транзакции по подпискам: <b>{{$this->countOrders}}</b> (<b>{{$this->priceOrders}} тг</b>)</p>
                <p class="my-2">Количество транзакции по турнирам: <b>{{$this->countTournaments}}</b> (<b>{{$this->priceTournaments}} тг</b>)</p>
                <p class="my-2">Количество транзакции по профтестам: <b>{{$this->countCareers}}</b> (<b>{{$this->priceCareers}} тг</b>)</p>
                <p class="my-2">Общее поступление: <b>{{$this->total}} тг</b></p>
            </div>
        </div>
    </div>
</div>
