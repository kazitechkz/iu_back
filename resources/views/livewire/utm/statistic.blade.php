<div>
    <div class="my-3 flex">
        <select wire:model="page" class="form-control">
            <option value="0">Все</option>
            @foreach($allPages as $item)
                <option value="{{$item->id}}">{{$item->title}}</option>
            @endforeach
        </select>
        <input type="date" class="form-control ml-2" wire:model="date">
    </div>
    <table class="table border-black">
        <thead>
        <tr>
            <th scope="col">Страницы</th>
            <th scope="col">Количество кликов: <span class="underline">{{$dateTitle}}</span></th>
        </tr>
        </thead>
        <tbody>
        @foreach($this->pages as $page)
            <tr>
                <th scope="row">{{$page->title}} <br> <span><small>{{$page->url}}</small></span></th>
                <td>{{$page->utms_sum_count??0}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
