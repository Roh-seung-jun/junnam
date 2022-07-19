@extends('header')
@section('script')

@endsection

@section('contents')
    <div class="d-flex justify-content-center align-items-center flex-column w-100" style="height: 100vh;">
        <h1>커뮤니티</h1>
        <div class="d-flex w-50 justify-content-between">
            @foreach(\App\Category::all() as $c)
                <a class="@if($c->id == $category) active @endif"
                href="{{route('border',['category_id'=>$c->id])}}">{{$c->category}}</a>
            @endforeach
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>제목</th>
                <th>작성자 이름</th>
                <th>작성날짜</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{$item->title}}</td>
                <td>{{$item->user->name}}</td>
                <td>{{$item->create_dt}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
