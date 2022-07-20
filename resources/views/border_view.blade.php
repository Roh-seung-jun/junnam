@extends('header')
@section('contents')
    <div class="d-flex justify-content-center align-items-center flex-column w-100" style="height: 100vh;">
        <h1>{{$data['border']['title']}}</h1>
        <p class="m-3">작성자 : {{$data['border']->user->name}}</p>
        <p class="m-3">{{$data['border']->category->category}}</p>
        <p class="m-3">{{$data['border']['contents']}}</p>
        <p class="m-3">모집 인원 : {{ getBorder($data['border'])->count()+1}} / {{$data['border']['personnel']+1}}</p>
        @if( getBorder($data['border'])->count()+1 < $data['border']['personnel']+1 && auth()->user()->id !== $data['border']['user_id'])
        <form action="{{route('create')}}" method="post">
            @csrf
            <input type="text" class="d-none" value="{{$data['border']['id']}}" name="id">
            <button class="btn btn-outline-warning" type="submit">
                모집신청
            </button>
        </form>
        @endif
        <h3 class="mt-4">버스킹 인원</h3>
        <div class="d-flex">
            <div class="box m-1">
                <img src="{{asset('./public/user/'.auth()->user()->image)}}" alt="" style="width: 50px;height: 50px">
                <p class="text-center">{{auth()->user()->name}}</p>
            </div>
        @foreach(getUser($data['border']['id'],'accept') as $item)
            <div class="box m-1">
                <img src="{{asset('./public/user/'.$item->user->image)}}" alt="" style="width: 50px;height: 50px">
                <p class="text-center">{{$item->user->name}}</p>
            </div>
        @endforeach
        </div>
        @if(auth()->user()->id === $data['border']['user_id'])
            <h2>버스킹 신청 명단</h2>
            <div class="d-flex" style="height: 200px">
                @foreach(getUser($data['border']['id'],'wait') as $item)
                <div class="box d-flex justify-content-center align-items-center flex-column m-3" style="width: 150px; height: 200px">
                    <img src="{{asset('./public/user/'.$item->user->image)}}" alt="" style="width: 50px;height: 50px">
                    <p class="text-center m-0">{{$item->user->name}}</p>
                    <p class="text-center">{{\App\Category::find($item->user->category_id)['category']}}</p>
                    <div class="d-flex w-100 justify-content-center">
                        <button class="btn btn-outline-success m-1" onclick="location.href='{{route('accept',['state'=>'accept','id'=>$item['id']]) }}'">수락</button>
                        <button class="btn btn-outline-danger m-1" onclick="location.href='{{route('accept',['state'=>'reject','id'=>$item['id']])}}'">거절</button>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

    </div>
@endsection
