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
    <h4 style="text-align: center">@lang('welcome.48')</h4>
    <p style="text-align: left"><b>@lang('welcome.59'):</b> {{$x->obl}}  </p>
    <p style="text-align: left"><b>Район:</b> {{$x->raion}}</p>
    <p style="text-align: left"><b>@lang('welcome.47'):</b> {{$x->name_rus}}</p>
    <p style="text-align: left"><b>@lang('welcome.12'):</b> {{$x->num_class}}</p>
    <p style="text-align: left"><b>@lang('welcome.13'):</b> {{$x->liter_class}}</p>
    <p style="text-align: right"><b>@lang('welcome.49'):</b> {{ $date }}</p>
    <table>
        <thead>
            <tr>
                <th rowspan="3">№</th>
                <th rowspan="3">@lang('welcome.42')</th>
                <th colspan="4">@lang('welcome.49')</th>
                <th rowspan="3">@lang('welcome.50')</th>
            </tr>
            <tr>
                <td colspan="2">@lang('welcome.51')</td>
                <td colspan="2">@lang('welcome.52')</td>
            </tr>
        <tr>
            <td>@lang('welcome.53')</td>
            <td>@lang('welcome.54')</td>
            <td>@lang('welcome.53')</td>
            <td>@lang('welcome.54')</td>
        </tr>
        </thead>
        <tbody>
            @foreach($studentTests as $key => $st)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$st->lastname.' '.$st->firstname.' '.$st->patronymic}}</td>
                    <td>{{$st->name_rus1}}</td>
                    <td>{{$st->ball1}}</td>
                    <td>{{$st->name_rus2}}</td>
                    <td>{{$st->ball2}}</td>
                    <td>{{$st->ball1+$st->ball2}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
</body>
</html>