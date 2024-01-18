<div class="table-responsive">
    <table class="table table-bordered table-sm">
        <tbody>
        <tr>
            <td rowspan="2" >
                <p ><span>№</span></p>
            </td>
            <td rowspan="2" >
                <p ><span>Предметы</span></p>
            </td>
            <td colspan="3" >
                <p ><span >Общее</span></p>
            </td>
            <td colspan="3" >
                <p ><span >Grant +</span></p>
            </td>
            <td colspan="3" >
                <p ><span >Bobo</span></p>
            </td>
            <td colspan="3" >
                <p ><span >Шың</span></p>
            </td>
            <td colspan="3" >
                <p ><span >Орбитал</span></p>
            </td>
            <td colspan="3" >
                <p ><span >IStudy.kz</span></p>
            </td>
            <td colspan="3" >
                <p ><span >Другие</span></p>
            </td>
        </tr>
        <tr>
            <td >
                <p ><span >kk</span></p>
            </td>
            <td >
                <p ><span >ru</span></p>
            </td>
            <td >
                <p ><span >%</span></p>
            </td>
            <td >
                <p ><span >kk</span></p>
            </td>
            <td >
                <p ><span >ru</span></p>
            </td>
            <td >
                <p ><span >%</span></p>
            </td>
            <td >
                <p ><span >kk</span></p>
            </td>
            <td >
                <p ><span >ru</span></p>
            </td>
            <td >
                <p ><span >%</span></p>
            </td>
            <td >
                <p ><span >kk</span></p>
            </td>
            <td >
                <p ><span >ru</span></p>
            </td>
            <td >
                <p ><span >%</span></p>
            </td>
            <td >
                <p ><span >kk</span></p>
            </td>
            <td >
                <p ><span >ru</span></p>
            </td>
            <td >
                <p ><span >%</span></p>
            </td>
            <td >
                <p ><span >kk</span></p>
            </td>
            <td >
                <p ><span >ru</span></p>
            </td>
            <td >
                <p ><span >%</span></p>
            </td>
            <td >
                <p ><span >kk</span></p>
            </td>
            <td >
                <p ><span >ru</span></p>
            </td>
            <td >
                <p ><span >%</span></p>
            </td>
        </tr>
            @foreach($subjects as $subject)
                <tr>
                    <td >
                        <p >{{$loop->iteration}}</p>
                    </td>
                    <td >
                        <p >
                            {{$subject->title_ru}}</p>
                    </td>
                    <td >
                        <p ><span >{{$subject->questions_kk_count}}</span></p>
                    </td>
                    <td >
                        <p ><span >{{$subject->questions_ru_count}}</span></p>
                    </td>
                    <td >
                        <p ><span><b>100</b></span></p>
                    </td>
                    <td >
                        <p ><span >{{$subject->questions_grant_kk_count}}</span></p>
                    </td>
                    <td >
                        <p ><span >{{$subject->questions_grant_ru_count}}</span></p>
                    </td>
                    <td >
                        <p ><span class="font-weight-bold">{{round((($subject->questions_grant_kk_count+$subject->questions_grant_ru_count)/$subject->questions_count)*100, 1)}}</span></p>
                    </td>
                    <td >
                        <p ><span >{{$subject->questions_bobo_kk_count}}</span></p>
                    </td>
                    <td >
                        <p ><span >{{$subject->questions_bobo_ru_count}}</span></p>
                    </td>
                    <td >
                        <p ><span class="font-weight-bold">{{round((($subject->questions_bobo_kk_count+$subject->questions_bobo_ru_count)/$subject->questions_count)*100, 1)}}</span></p>
                    </td>
                    <td >
                        <p ><span >{{$subject->questions_shin_kk_count}}</span></p>
                    </td>
                    <td >
                        <p ><span >{{$subject->questions_shin_ru_count}}</span></p>
                    </td>
                    <td >
                        <p ><span class="font-weight-bold">{{round((($subject->questions_shin_kk_count+$subject->questions_shin_ru_count)/$subject->questions_count)*100, 1)}}</span></p>
                    </td>
                    <td >
                        <p ><span >{{$subject->questions_orbital_kk_count}}</span></p>
                    </td>
                    <td >
                        <p ><span >{{$subject->questions_orbital_ru_count}}</span></p>
                    </td>
                    <td >
                        <p ><span class="font-weight-bold">{{round((($subject->questions_orbital_kk_count+$subject->questions_orbital_ru_count)/$subject->questions_count)*100, 1)}}</span></p>
                    </td>
                    <td >
                        <p ><span >{{$subject->questions_istudy_kk_count}}</span></p>
                    </td>
                    <td >
                        <p ><span >{{$subject->questions_istudy_ru_count}}</span></p>
                    </td>
                    <td >
                        <p ><span class="font-weight-bold">{{round((($subject->questions_istudy_kk_count+$subject->questions_istudy_ru_count)/$subject->questions_count)*100, 1)}}</span></p>
                    </td>
                    <td >
                        <p ><span >{{$subject->questions_other_kk_count}}</span></p>
                    </td>
                    <td >
                        <p ><span >{{$subject->questions_other_ru_count}}</span></p>
                    </td>
                    <td >
                        <p ><span class="font-weight-bold">{{round((($subject->questions_other_kk_count+$subject->questions_other_ru_count)/$subject->questions_count)*100, 1)}}</span></p>
                    </td>
                </tr>
            @endforeach
        <tr>
            <td colspan="2" rowspan="2" >
                <p ><span>Итого</span></p>
            </td>
            <td >
                <p ><span >{{$questions['all_kk']}}</span></p>
            </td>
            <td >
                <p ><span >{{$questions['all_ru']}}</span></p>
            </td>
            <td >
                <p ><span class="font-weight-bold">100</span></p>
            </td>
            <td >
                <p ><span >{{$questions['grant_kk']}}</span></p>
            </td>
            <td >
                <p ><span >{{$questions['grant_ru']}}</span></p>
            </td>
            <td >
                <p ><span class="font-weight-bold">{{$questions['grant_per']}}</span></p>
            </td>
            <td >
                <p ><span >{{$questions['bobo_kk']}}</span></p>
            </td>
            <td >
                <p ><span >{{$questions['bobo_ru']}}</span></p>
            </td>
            <td >
                <p ><span class="font-weight-bold">{{$questions['bobo_per']}}</span></p>
            </td>
            <td >
                <p ><span >{{$questions['shin_kk']}}</span></p>
            </td>
            <td >
                <p ><span >{{$questions['shin_ru']}}</span></p>
            </td>
            <td >
                <p ><span class="font-weight-bold">{{$questions['shin_per']}}</span></p>
            </td>
            <td >
                <p ><span >{{$questions['orbital_kk']}}</span></p>
            </td>
            <td >
                <p ><span >{{$questions['orbital_ru']}}</span></p>
            </td>
            <td >
                <p ><span class="font-weight-bold">{{$questions['orbital_per']}}</span></p>
            </td>
            <td >
                <p ><span >{{$questions['istudy_kk']}}</span></p>
            </td>
            <td >
                <p ><span >{{$questions['istudy_ru']}}</span></p>
            </td>
            <td >
                <p ><span class="font-weight-bold">{{$questions['istudy_per']}}</span></p>
            </td>
            <td >
                <p ><span >{{$questions['other_kk']}}</span></p>
            </td>
            <td >
                <p ><span >{{$questions['other_ru']}}</span></p>
            </td>
            <td >
                <p ><span class="font-weight-bold">{{$questions['other_per']}}</span></p>
            </td>
        </tr>
        <tr>
            <td colspan="3" >
                <p ><span class="font-weight-bold">{{$questions['all']}}</span></p>
            </td>
            <td colspan="3" >
                <p ><span class="font-weight-bold">{{$questions['grant_all']}}</span></p>
            </td>
            <td colspan="3" >
                <p ><span class="font-weight-bold">{{$questions['bobo_all']}}</span></p>
            </td>
            <td colspan="3" >
                <p ><span class="font-weight-bold">{{$questions['shin_all']}}</span></p>
            </td>
            <td colspan="3" >
                <p ><span class="font-weight-bold">{{$questions['orbital_all']}}</span></p>
            </td>
            <td colspan="3" >
                <p ><span class="font-weight-bold">{{$questions['istudy_all']}}</span></p>
            </td>
            <td colspan="3" >
                <p ><span class="font-weight-bold">{{$questions['other_all']}}</span></p>
            </td>
        </tr>
        </tbody>
    </table>
</div>
