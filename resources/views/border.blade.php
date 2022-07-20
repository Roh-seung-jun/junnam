@extends('header')
@section('script')

@endsection

@section('contents')
    <div class="d-flex justify-content-center align-items-center flex-column w-100" style="height: 100vh;">
        <h1>커뮤니티</h1>
        <div class="d-flex w-50 justify-content-between">
            <a class="@if($category == 'all') active @endif"
               href="{{route('border',['category_id'=>'all'])}}">전체</a>
        @foreach(\App\Category::all() as $c)
                <a class="@if($c->id == $category) active @endif"
                href="{{route('border',['category_id'=>$c->id])}}">{{$c->category}}</a>
            @endforeach
        </div>
        <table class="table w-75">
            <thead>
            <tr>
                <th>제목</th>
                <th>작성자 이름</th>
                <th>작성날짜</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
            <tr onclick="location.href='{{route('detail',$item['id'])}}'">
                <td>{{$item->title}}</td>
                <td>{{$item->user->name}}</td>
                <td>{{$item->create_dt}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{$data->appends(request()->input())->links()}}
        <button class="m-4 btn btn-outline-warning" data-target="#write" data-toggle="modal">모집글 작성</button>
    </div>
    <div class="modal fade" id="write">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="header">
                    <h3 class="modal-title">모집글 작성</h3>
                </div>
                <div class="modal-body">
                    <form action="{{route('write')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <p class="m-0">제목</p>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <p class="m-0">내용</p>
                            <input type="text" class="form-control" name="contents">
                        </div>
                        <div class="form-group">
                            <p class="m-0">모집 인원</p>
                            <input type="number" class="form-control" name="personnel">
                        </div>
                        <div class="form-group">
                            <p class="m-0">분야</p>
                            <select name="category_id" id="cate" class="custom-select">
                                @foreach($type as $idx => $item)
                                    <option value="{{$idx}}">{{$item->category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-outline-warning">모집글 작성</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
