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
            @foreach($orders as $order)
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
            <livewire:admin-dashboard.get-subject-stats :subjectID="$this->subjectID" :date="$this->date"/>
        </div>
    @endif

</div>
