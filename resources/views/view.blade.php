@extends('header')
@section('script')
@endsection

@section('style')
    <style>
        td{width: calc(100% / 7)}
    </style>
@endsection
@section('contents')
    <div class="d-flex justify-content-center align-items-center w-100 flex-column">
        <h1 style="margin-top: 100px;">정원 상세보기 페이지</h1>
        <table class="table w-50" style="margin-top: 100px;">
            <thead>
            <tr>
                <td>일</td>
                <td>월</td>
                <td>화</td>
                <td>수</td>
                <td>목</td>
                <td>금</td>
                <td>토</td>
            </tr>
            </thead>
            <tbody>
            @for($i = 0,$day = 1; $i < $total_week;$i++)
            <tr>
                @for($a = 0;$a < 7; $a++)
                    <td>
                        @if(($day > 0 || $a < $start_week) && $total_day >= $day)
                            @if(getEvent($year,$month,$day,['id'=>$id,'time'=> null])->count() !== 0)
                            <button class="btn btn-outline-dark" data-toggle="modal" data-target="#modal_{{$day}}">상세보기</button>
                            <div class="modal fade" id="modal_{{$day}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">일정보기</h3>
                                        </div>
                                        <div class="modal-content">
                                            @for( $j = getStart($year,$month,$day) ; $j < getEnd($year,$month,$day);$j++)
                                                <div class="line" style="border: 1px solid #ccc;margin: 10px;padding: 5px;border-radius: 10px">
                                                    <p>{{$j}} : 00 ~ {{$j+1}} : 00</p>
                                                    @foreach(getEvent($year,$month,$day,['id'=>$id,'time'=>$j]) as $item)
                                                        <p>버스킹 이름 : {{$item->name}}</p>
                                                        <p>버스킹 분야 : {{\App\Category::find($item->category_id)['category']}}</p>
                                                        <p>버스커 : {{\App\User::find($item->user_id)['name']}}</p>
                                                    @endforeach
                                                </div>
                                            @endfor
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn-outline-dark btn">일정</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endif
                        {{$day++}}
                    </td>
                @endfor
            </tr>
            @endfor
            </tbody>
        </table>
    </div>
@endsection
