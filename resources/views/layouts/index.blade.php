{{URL::forceSchema('https')}}
<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Регистрация ВОУДСО @yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>ВОУД СО</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://group-voudso.debug.testcenter.kz/css/datatables.min.css" rel="stylesheet"> 
    <link href="https://group-voudso.debug.testcenter.kz/css/simple-sidebar.css" rel="stylesheet">
    <style>
        .tooltip { /* стиль текста, наведя или нажав на который появится пояснение */
            display: inline-block;
            position: relative;
            background: #E6E6E6; /* цвет фона */
            text-indent: 0px;
            cursor: help; /* вид курсора */
        }
        .tooltip > span { /* стиль появляющейся подсказки */
            position: absolute;
            bottom: 100%;
            left: -20em; /* = max-width */
            right: -20em; /* = max-width */
            width: -moz-max-content;
            width: -webkit-max-content;
            width: max-content;  /* ширина подсказки может быть не более содержимого */
            max-width: 20em;  /* ширина подсказки может быть не более 20em */
            max-height: 80vh; /* необязательное ограничение по высоте подсказки, 1vh — это 1% от ширины окна */
            overflow: auto;
            visibility: hidden;
            margin: 0 auto .4em; /* поднята на .4em над текстом, наведя или нажав на который появится пояснение */
            padding: .3em;
            border: solid rgb(200,200,200);
            font-size: 90%;
            background: #fff;
            line-height: normal;
            cursor: auto;
        }
        .tooltip.left > span { /* начинается от левого края */
            left: 0;
            right: -20em;
            margin: 0 0 .4em;
        }
        .tooltip.right > span { /* начинается от правого края */
            left: -20em;
            right: 0;
            margin: 0 0 .4em auto;
        }
        .tooltip:after { /* треугольничек под подсказкой; тут тоже везде .4em */
            content: "";
            position: absolute;
            top: -.4em;
            left: 50%;
            visibility: hidden;
            margin: 0 0 0 -.4em;
            border: .4em solid;
            border-color: rgb(200,200,200) transparent transparent transparent;
            cursor: auto;
        }
        .tooltip.left:after {
            left: 1em;
        }
        .tooltip.right:after {
            left: auto;
            right: .6em; /* 1em - .4em */
        }
        .tooltip:before { /* поле между текстом, наведя или нажав на который появится пояснение, и подсказкой нужно чтобы, если перевести курсор мышки на подсказку, та не исчезла; тут тоже везде .4em */
            content: "";
            position: absolute;
            top: -.4em;
            left: 0;
            right: 0;
            height: .4em;
            visibility: hidden;
        }
        .tooltip:hover > span,
        .tooltip:hover:before,
        .tooltip:hover:after,
        .tooltip:focus > span,
        .tooltip:focus:before,
        .tooltip:focus:after {
            visibility: visible;
            transition: 0s .4s;
        }
        .tooltip:focus { /* убрать рамку в Хроме */
            outline: none;
        }
        .tooltip.anim > span,
        .tooltip.anim:after { /* анимация */
            opacity: 0;
            transform: translateY(1.5em) scale(.3);
            transform-origin: center bottom;
        }
        .tooltip.anim:after {
            transform: translateY(.7em) scale(.3); /* 1.7 = 1.5 / (1.4*2) */
        }
        .tooltip.anim:hover > span,
        .tooltip.anim:hover:after,
        .tooltip.anim:focus > span,
        .tooltip.anim:focus:after {
            opacity: 1;
            transition: .6s .4s;
            transform: translateY(0);
        }
        @media (max-width: 20em) { /* ширина подсказки может быть не более ширины окна браузера */
            .tooltip > span {
                max-width: 100vw; /* в 100vw входит полоса прокрутки, но на мобильных она часто отсутствует */
                box-sizing: border-box;
            }
        }

    </style>

    <!-- jQuery -->
    <script src="https://group-voudso.debug.testcenter.kz/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://group-voudso.debug.testcenter.kz/js/datatables.min.js"></script>
    <script>
        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays*24*60*60*1000));
            var expires = "expires="+ d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }
    </script>
</head>

<body>

   <nav class="navbar navbar-default" style="background-color: #127989;">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="#" style="font-size: 18px; color: #ffffff" data-toggle="modal" data-target="#InstrModal">@lang('welcome.60')</a></li>
                    @section('menu')
                    <li class="dropdown">
                        <a href="#" style="font-size: 18px; color: #ffffff" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> @lang('welcome.8') <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('home') }}" style="font-size: 18px; margin: 15px 0 15px 0; color: #127989;">@lang('welcome.1_1')</a></li>
                            <li><a href="{{ url('classes') }}" style="font-size: 18px; margin: 15px 0 15px 0; color: #127989;">@lang('welcome.2_1')</a></li>
                            <li><a href="{{ url('period') }}" style="font-size: 18px; margin: 15px 0 15px 0; color: #127989;">@lang('welcome.3_1')</a></li>
                            <li role="separator" class="divider"></li>
                            <div style="margin-left:20px;">
                            <li><b class="text-left">@lang('welcome.4_0')</b></li>
                            <li>@lang('welcome.4'): <span id="user_try"></span></li>
                            <li>@lang('welcome.5'): <span id="stud_try"></span></li>
                            <li>@lang('welcome.6'): <span id="cnt_try"></span></li>
                            </div>
                        </ul>
                    </li>
                        @show
                </ul>
                <ul class="nav navbar-nav" style="margin-left:5% "><li><a href="{{ url('/') }}" style="font-size: 18px; color: #ffffff">@lang('welcome.68')</a></li></ul>

                <ul class="nav navbar-nav navbar-right">

                    <li><a href="{{ url('setlocale/kz') }}" style="font-size: 18px; color: #ffffff;  padding-right: 0">Қазақша</a></li>
                    <li><a href="#" style="font-size: 18px; color: #ffffff; padding-left: 2px; padding-right: 2px">|</a></li>
                    <li><a href="{{ url('setlocale/ru') }}" style="font-size: 18px; color: #ffffff;  padding-left: 0;">Русский</a></li>
                    <li><a href="{{ url('logout') }}" style="font-size: 18px; color: #ffffff;">@lang('welcome.7')</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
        <div class="container-fluid">
            <ol class="breadcrumb">
                @section('nav')
                @show
            </ol>


            <div class="row">
                <div class="col-md-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
    <div class="modal fade bs-example-modal-lg" id="InstrModal" tabindex="-1" role="dialog" aria-labelledby="myInstrLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <iframe src="https://group-voudso.debug.testcenter.kz/instr_rus.htm" width="100%" height="600px" scrolling="yes"></iframe>
            </div>
        </div>
    </div>


<!-- Menu Toggle Script -->
<script>

    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        if(getCookie("menu") == 1){
            setCookie("menu", 0, 365);
        }else{
            setCookie("menu", 1, 365);
        }
    });

    function allcheck() {
        var chkBoxes = $("input[name=SelectItem]");
        chkBoxes.prop("checked", !chkBoxes.prop("checked"));
    }

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post('{{ url('cntTry') }}',  { }, function(data){
            $('#user_try').html(data.userTry);
            $('#stud_try').html(data.studTry);
            $('#cnt_try').html(data.cntTry);
        });

        $('#example').DataTable();

        $('#exampleStud').DataTable();

        $('#select-classes').change(function() {

            var t = $('#select-classes').val();
            var n = t.split("|");

            $.post('{{ url('getStudentClass') }}',  { n:n[0], l:n[1]}, function(data){
                console.log(data);
                $('#students').html(data);
            });
        });

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        @yield('js')


    } );

</script>

</body>

</html>
