<div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Предметы</th>
            <th scope="col">Каз</th>
            <th scope="col">Рус</th>
        </tr>
        </thead>
        <tbody>
            @foreach($subjects as $subject)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$subject->title_ru}}</td>
                    <td>{{$subject->questions_kk_count}}
                        / <span class="text-green-500">{{$subject->questions_kk_sorted_count}}</span>
                        / <span class="text-red-500">{{$subject->questions_kk_count - $subject->questions_kk_sorted_count}}</span>
                        / ({{round($subject->questions_kk_sorted_count*100/$subject->questions_kk_count)}} %)
                    </td>
                    <td>{{$subject->questions_ru_count}}
                        / <span class="text-green-500">{{$subject->questions_ru_sorted_count}}</span>
                        / <span class="text-red-500">{{$subject->questions_ru_count - $subject->questions_ru_sorted_count}}</span>
                        / ({{round($subject->questions_ru_sorted_count*100/$subject->questions_ru_count)}} %)
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
