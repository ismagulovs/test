{{URL::forceSchema('https')}}
<!DOCTYPE html>
<html lang="ru">

<head>
    <title>@lang('welcome.68') @yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <script src="./js/jquery.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <style>
        .centered {
            /* position: ;  or absolute */
            top: 50%;
            left: 50%;
            width: 400px;
            height:400px;
           /* margin: -250px 0 0 -200px;*/
        }
    </style>
</head>

<body>
<nav class="navbar navbar-default" style="background-color: #127989;">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="#" style="font-size: 18px; color: #ffffff" data-toggle="modal" data-target="#InstrModal">@lang('welcome.60')</a></li>
            </ul>
            <ul class="nav navbar-nav" style="margin-left:17% "><li><a href="#" style="font-size: 18px; color: #ffffff">@lang('welcome.68')</a></li></ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('setlocale/kz') }}" style="font-size: 18px; color: #ffffff;   padding-right: 0px">Қазақша</a></li>
                <li><a href="#" style="font-size: 18px; color: #ffffff; padding-left: 2px; padding-right: 2px">|</a></li>
                <li><a href="{{ url('setlocale/ru') }}" style="font-size: 18px; color: #ffffff; padding-left: 0px;">Русский</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="centered">
                <form method="POST" action="/login">
                    {!! csrf_field() !!}

                    {{--<h1> @lang('welcome.welcome')   {{session('locale')}} </h1>--}}
                    <div class="form-group  {{$errors->has('login') ? 'has-error' : ''}}">
                        Логин
                        <input type="text"  class="form-control"  name="login" value="{{ old('login') }}">
                    </div>

                    <div class="form-group">
                        Пароль
                        <input type="password"  class="form-control"  name="password" id="password">
                    </div>
                    @if($errors->has('login'))
                        <div class="alert alert-danger" role="alert">{{$errors->first('login')}}</div>
                    @elseif($errors->has('password'))
                        <div class="alert alert-danger" role="alert">{{$errors->first('password')}}</div>
                    @elseif($errors->has('pass'))
                        <div class="alert alert-danger" role="alert">{{$errors->first('pass')}}</div>
                    @endif
                    <div class="form-group">
                        <button type="submit" class="btn btn-default" style="background-color: #127989; color: #ffffff;">@lang('welcome.67')</button>
                    </div>
                </form>
    </div>
        <div class="modal fade bs-example-modal-lg" id="InstrModal" tabindex="-1" role="dialog" aria-labelledby="myInstrLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <iframe src="https://group-voudso.debug.testcenter.kz/instr_rus.htm" width="100%" height="600px" scrolling="yes"></iframe>
                </div>
            </div>
        </div>

</div>

</body>
</html>
