<div>
    <div class="my-3">
        <input type="text" class="form-control" wire:model="searchTerm" placeholder="Поиск по имени или email">
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Имя</th>
            <th scope="col">Почта</th>
            <th scope="col">Баланс</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($wallets as $wallet)
            <tr>
                <th scope="row">{{$wallet->holder->id}}</th>
                <td>{{$wallet->holder->name}}</td>
                <td>{{$wallet->holder->email}}</td>
                <td>{{$wallet->holder->balanceInt}}</td>
                <td>
                    <a href="{{route('wallet.edit', $wallet->id)}}">Редактировать</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="my-3">
        {!! $wallets->links() !!}
    </div>
</div>
