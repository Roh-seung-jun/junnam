<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('./public/bootstrap-4.4.1/dist/css/bootstrap.css')}}">
    <script src="{{asset('./public/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('./public/bootstrap-4.4.1/dist/js/bootstrap.js')}}"></script>
    @yield('style')
    @yield('script')
    <script>
        @if(\Illuminate\Support\Facades\Session::has('msg'))
                alert('{{session('msg')}}')
            @endif
    </script>
</head>
<body>
@yield('contents')
</body>
</html>
