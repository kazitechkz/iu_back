<div class="table-responsive">
    <table class="table table-bordered table-sm">
        <tbody>
        <tr>
            <td rowspan="2" >
                <p ><span class="font-weight-bold">№</span></p>
            </td>
            <td rowspan="2" >
                <p ><span class="font-weight-bold">Предметы</span></p>
            </td>
            <td colspan="2" >
                <p ><span class="font-weight-bold">С одним ответом</span></p>
            </td>
            <td colspan="2" >
                <p ><span class="font-weight-bold">Контекстный</span></p>
            </td>
            <td colspan="2" >
                <p ><span class="font-weight-bold">С множественным ответом</span></p>
            </td>
{{--            <td colspan="2" >--}}
{{--                <p ><span class="font-weight-bold">Конспекты</span></p>--}}
{{--            </td>--}}
{{--            <td colspan="2" >--}}
{{--                <p ><span class="font-weight-bold">Видео</span></p>--}}
{{--            </td>--}}
        </tr>
        <tr>
            <td >
                <p ><span class="font-weight-bold">kk</span></p>
            </td>
            <td >
                <p ><span class="font-weight-bold">ru</span></p>
            </td>
            <td >
                <p ><span class="font-weight-bold">kk</span></p>
            </td>
            <td >
                <p ><span class="font-weight-bold">ru</span></p>
            </td>
            <td >
                <p ><span class="font-weight-bold">kk</span></p>
            </td>
            <td >
                <p ><span class="font-weight-bold">ru</span></p>
            </td>
{{--            <td >--}}
{{--                <p ><span class="font-weight-bold">kk</span></p>--}}
{{--            </td>--}}
{{--            <td >--}}
{{--                <p ><span class="font-weight-bold">ru</span></p>--}}
{{--            </td>--}}
{{--            <td >--}}
{{--                <p ><span class="font-weight-bold">kk</span></p>--}}
{{--            </td>--}}
{{--            <td >--}}
{{--                <p ><span class="font-weight-bold">ru</span></p>--}}
{{--            </td>--}}
        </tr>
            @foreach($subjects as $subject)
                <tr>
                    <td >
                        <p class="font-weight-bold">{{$loop->iteration}}</p>
                    </td>
                    <td >
                        <p class="font-weight-bold">
                            {{$subject->title_ru}}</p>
                    </td>
                    <td >
                        <p ><span >{{$subject->questions_single_type_kk_count}}</span></p>
                    </td>
                    <td >
                        <p ><span >{{$subject->questions_single_type_ru_count}}</span></p>
                    </td>
                    <td >
                        <p ><span >{{$subject->questions_context_type_kk_count}}</span></p>
                    </td>
                    <td >
                        <p ><span >{{$subject->questions_context_type_ru_count}}</span></p>
                    </td>
                    <td >
                        <p ><span >{{$subject->questions_multi_type_kk_count}}</span></p>
                    </td>
                    <td >
                        <p ><span >{{$subject->questions_multi_type_ru_count}}</span></p>
                    </td>
{{--                    <td >--}}
{{--                        <p ><span >{{$subject->questions_shin_kk_count}}</span></p>--}}
{{--                    </td>--}}
{{--                    <td >--}}
{{--                        <p ><span >{{$subject->questions_shin_ru_count}}</span></p>--}}
{{--                    </td>--}}
{{--                    <td >--}}
{{--                        <p ><span >{{$subject->questions_orbital_kk_count}}</span></p>--}}
{{--                    </td>--}}
{{--                    <td >--}}
{{--                        <p ><span >{{$subject->questions_orbital_ru_count}}</span></p>--}}
{{--                    </td>--}}
                </tr>
            @endforeach
        <tr>
            <td colspan="2" rowspan="2" >
                <p ><span class="font-weight-bold">Итого</span></p>
            </td>
            <td >
                <p ><span >{{$questions['single_all_kk']}}</span></p>
            </td>
            <td >
                <p ><span >{{$questions['single_all_ru']}}</span></p>
            </td>
            <td >
                <p ><span >{{$questions['context_all_kk']}}</span></p>
            </td>
            <td >
                <p ><span >{{$questions['context_all_ru']}}</span></p>
            </td>
            <td >
                <p ><span >{{$questions['multi_all_kk']}}</span></p>
            </td>
            <td >
                <p ><span >{{$questions['multi_all_ru']}}</span></p>
            </td>
{{--            <td >--}}
{{--                <p ><span >{{$questions['shin_kk']}}</span></p>--}}
{{--            </td>--}}
{{--            <td >--}}
{{--                <p ><span >{{$questions['shin_ru']}}</span></p>--}}
{{--            </td>--}}
{{--            <td >--}}
{{--                <p ><span >{{$questions['orbital_kk']}}</span></p>--}}
{{--            </td>--}}
{{--            <td >--}}
{{--                <p ><span >{{$questions['orbital_ru']}}</span></p>--}}
{{--            </td>--}}
        </tr>
        <tr>
            <td colspan="2" >
                <p ><span class="font-weight-bold">{{$questions['single_all_kk'] + $questions['single_all_ru']}}</span></p>
            </td>
            <td colspan="2" >
                <p ><span class="font-weight-bold">{{$questions['context_all_kk'] + $questions['context_all_ru']}}</span></p>
            </td>
            <td colspan="2" >
                <p ><span class="font-weight-bold">{{$questions['multi_all_kk'] + $questions['multi_all_ru']}}</span></p>
            </td>
{{--            <td colspan="2" >--}}
{{--                <p ><span class="font-weight-bold">{{$questions['shin_all']}}</span></p>--}}
{{--            </td>--}}
{{--            <td colspan="2" >--}}
{{--                <p ><span class="font-weight-bold">{{$questions['orbital_all']}}</span></p>--}}
{{--            </td>--}}
        </tr>
        </tbody>
    </table>
</div>
