 <!DOCUMENT>
<html lang="ru">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
</head>
<style>
    body{
        font-family: DejaVu Sans
    }
    .container{
        margin: auto;
        width: 100%;
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
    <h4 style="text-align: center;">@lang('welcome.56')
        ( {{ $title }} )
    </h4>
    <table>
        <thead>
            <tr>
                <th>№</th>
                <th>@lang('welcome.37')</th>
                <th>@lang('welcome.38')</th>
                <th>@lang('welcome.42')</th>
                <th>@lang('welcome.43')</th>
                <th>@lang('welcome.44')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($studentTests as $key => $st)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$st->iin}}</td>
                    <td>{{$st->test_pass}}</td>
                    <td>{{$st->lastname.' '.$st->firstname.' '.$st->patronymic}}</td>
                    <td>{{$st->num_class.$st->liter_class}}</td>
                    <td>{{$st->lang}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
</body>
</html>