<!DOCUMENT>
<html lang="ru">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
</head>
<style>
    body{
        font-family: DejaVu Sans;
        font-size: 12px;
    }
    .container{
        margin: auto;
        width: 90%;
        padding: 10px;
    }
    TABLE {
        border-collapse: collapse; /* Убираем двойные линии между ячейками */
        margin: 0 auto;
    }
    TH {
        text-align: center; /* Выравнивание по левому краю */
    }
    TD {
        background: #fff; /* Цвет фона ячеек */
        text-align: center; /* Выравнивание по центру */
    }
    TH, TD {
        border: 1px solid black; /* Параметры рамки */
        padding: 4px; /* Поля вокруг текста */
    }
</style>
<body>
<div class="container">
    <h4 style="text-align: center">@lang('welcome.57')</h4>

    <p style="text-align: left">@lang('welcome.42'): {{$stud->lastname.' '.$stud->firstname.' '.$stud->patronymic}}</p>
    <p style="text-align: left">@lang('welcome.2_2'): {{$stud->num_class.' '.$stud->liter_class}}</p>
    <p style="text-align: left">@lang('welcome.47'): {{$stud->name_rus}}</p>

    <table>
        <thead>
            <tr>
                <td></td>
                @for($i = 1; $i < 41; $i++)
                    <td>{{$i}}</td>
                @endfor
            </tr>
        </thead>
        <tbody>
            <tr><td colspan="41">{{$sub1}}</td></tr>
            <tr>
                <td>@lang('welcome.58')</td>
                @for($i = 0; $i < 40; $i++)
                    @if(isset($answers_arr_sub1[$i+1]))
                        <td>{{$answers_arr_sub1[$i+1]}}</td>
                    @else
                        <td>_</td>
                    @endif
                @endfor
            </tr>
            <tr>
                <td>@lang('welcome.59')</td>
                @for($i = 0; $i < 40; $i++)
                    @if(isset($ball_arr_sub1[$i+1]))
                        <td>{{$ball_arr_sub1[$i+1]}}</td>
                    @else
                        <td>_</td>
                    @endif
                @endfor
            </tr>
            <tr><td colspan="41">{{$sub2}}</td></tr>
            <tr>
                <td>@lang('welcome.58')</td>
                @for($i = 0; $i < 40; $i++)
                    @if(isset($answers_arr_sub2[$i+1]))
                        <td>{{$answers_arr_sub2[$i+1]}}</td>
                    @else
                        <td>_</td>
                    @endif
                @endfor
            </tr>
            <tr>
                <td>@lang('welcome.59')</td>
                @for($i = 0; $i < 40; $i++)
                    @if(isset($ball_arr_sub2[$i+1]))
                        <td>{{$ball_arr_sub2[$i+1]}}</td>
                    @else
                        <td>_</td>
                    @endif
                @endfor
            </tr>
        </tbody>
    </table>

</div>
</body>
</html>