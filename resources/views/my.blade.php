@extends('header')
@section('script')

@endsection

@section('contents')
    <div class="d-flex justify-content-center align-items-center flex-column w-100" style="height: 100vh;">
        <form action="{{route('set')}}" method="POST" class="w-25" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <p class="m-0">이름</p>
                <input type="text" name="name" class="form-control" value="{{auth()->user()->name}}">
            </div>
            <div class="form-group">
                <p class="m-0">소개 내용</p>
                <textarea name="introduce" class="form-control" >{{auth()->user()->introduce}}</textarea>
            </div>
            <div class="form-group">
                <p class="m-0">분야</p>
                <select name="category_id" id="" class="custom-select">
                    @foreach(\App\Category::all() as $item)
                    <option value="{{$item['id']}}"
                    @if($item['id'] === auth()->user()->category_id) selected @endif
                    >{{$item['category']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <p class="m-0">프로필 사진</p>
                <input type="file" name="image" class="custom-file form-control-file">
                <img src="{{asset('public/user/'.auth()->user()->image)}}" alt="" style="width: 100px;height: 100px;object-fit: cover">
            </div>
            <button class="btn btn-outline-info" type="submit">저장</button>
        </form>
        <table class="table w-75">
            <thead>
            <tr>
                <th>제목</th>
                <th>작성 날짜</th>
                <th>분야</th>
                <th>상태</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['list'] as $item)
                <tr>
                    <td>{{$item->title}}</td>
                    <td>{{$item->create_dt}}</td>
                    <td>{{\App\Category::find($item->category_id)['category']}}</td>
                    <td>
                        
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
