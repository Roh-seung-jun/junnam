@extends('header')
@section('script')
@endsection

@section('contents')
    <div class="d-flex justify-content-center align-items-center w-100 flex-column">
        <h1 style="margin-top: 100px;">정원 관람 체험페이지</h1>
        <table class="table w-50" style="margin-top: 100px;">
            <thead>
            <tr>
                <td>정원 이미지</td>
                <td>정원 이름</td>
                <td>정원 전화번호</td>
                <td>정원 위치</td>
            </tr>
            </thead>
            <tbody>
            @foreach($data['garden'] as $item)
                <tr onclick="location.href='{{route('view',$item['id'])}}'">
                    <td><img src="{{asset('./public/gardens/'.$item['image'])}}" alt="" style="width: 50px;height: 50px;object-fit: cover"></td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->connect}}</td>
                    <td>{{$item->location}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
