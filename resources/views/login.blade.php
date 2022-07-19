@extends('header')



@section('contents')
    <form class="d-flex justify-content-center align-items-center w-100 flex-column" style="height: 100vh;" action="{{route('login')}}" method="post">
        @csrf
        <div class="form-group">
            <p class="m-0">아이디</p>
            <input type="text" name="id" class="form-control" placeholder="아이디">
        </div>
        <div class="form-group">
            <p class="m-0">비밀번호</p>
            <input type="text" name="password" class="form-control" placeholder="비밀번호">
        </div>
        <button class="btn btn-outline-danger" type="submit">로그인</button>
    </form>
@endsection
