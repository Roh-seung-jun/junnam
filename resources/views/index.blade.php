@extends('header')
@section('script')
    <script>
        $(()=>{
            $(document)
                .on('click','#check',check)
                .on('click','.submit',checkValue)
        })
        function check(){
            let user = @json($data['user']);
            let value = $('#id').val();
            if(user.find(e=>e.id === value)){
                return alert('사용 불가능한 아이디입니다.');
            }
            return alert('사용 가능한 아이디입니다.');
        }

        function checkValue(){
            let id = $(`input[name="id"]`).val();
            let name = $(`input[name="name"]`).val();
            let pw = $(`input[name="pw"]`).val();
            const engNum =  /^[a-zA-Z0-9]*$/;
            if(!engNum.test(id)) return alert('아이디는 영문 및 숫자로 구성되어야 합니다.');
            if(!engNum.test(pw) || pw.length < 8) return alert('비밀번호는 영문 및 숫자로만 구성되며 8글자 이상이여야 합니다.');
            if(name.length < 2 && name.length > 5) return alert('이름은 2자 이상, 5자 이하여야 합니다.');
            $('.complete')[0].click();
        }

    </script>
@endsection

@section('contents')
    <div class="d-flex justify-content-center align-items-center w-100" style="height: 100vh;">
        @if(!auth()->user())
            <button class="btn btn-outline-success m-1" data-toggle="modal" data-target="#sign" >회원가입</button>
            <button class="btn btn-outline-danger m-1" onclick="location.href='{{route('login')}}'">로그인</button>
        @else
            <button class="btn btn-outline-success m-1" onclick="alert('로그인한 회원은 접근할 수 없습니다.')">회원가입</button>
            <button class="btn btn-outline-danger m-1" onclick="location.href='{{route('logout')}}'">로그아웃</button>
        @endif
        <button class="btn btn-outline-dark m-1" onclick="location.href='{{route('list')}}'">관람/체험 페이지</button>
        <button class="btn btn-outline-warning m-1" onclick="location.href='{{route('border')}}'">버스킹 커뮤니티 페이지</button>
    </div>
    <div class="modal fade" id="sign">
        <div class="modal-dialog">
                <form class="modal-content d-flex justify-content-center align-items-center w-100 flex-column" action="{{route('sign')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <p class="m-0">아이디</p>
                        <input required type="text" id="id" name="id" class="form-control" placeholder="아이디">
                    </div>
                    <button class="btn btn-outline-success h-50" type="button" id="check">아이디 중복확인</button>
                    <div class="form-group">
                        <p class="m-0">비밀번호</p>
                        <input required type="text" name="pw" class="form-control" placeholder="비밀번호">
                    </div>
                    <div class="form-group">
                        <p class="m-0">이름</p>
                        <input required type="text" name="name" class="form-control" placeholder="이름">
                    </div>
                    <div class="form-group">
                        <p class="m-0">전화번호</p>
                        <input required type="text" name="phone" class="form-control" placeholder="전화번호">
                    </div>
                    <div class="form-group">
                        <p class="m-0">분야</p>
                        <select name="category_id" id="asd" class="custom-select">
                            @foreach($data['category'] as $item)
                                <option value="{{$item['id']}}">{{$item['category']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <p class="m-0">프로필 사진</p>
                        <input type="file" name="photo" required>
                    </div>
                    <div class="form-group">
                        <p class="m-0">캡차</p>
                        <img src="{{route('captcha')}}" alt="captcha">
                        <input type="text" name="captcha" class="form-control" placeholder="captcha">
                    </div>
                    <button class="btn btn-outline-success submit" type="button">회원가입</button>
                    <button class="d-none complete" type="submit"></button>
                </form>
        </div>
    </div>
@endsection
