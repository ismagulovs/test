{{URL::forceSchema('https')}}
@extends('layouts.index')

@section('title', 'ВОУД СО')



@section('nav')
    @parent
    {{--<li class="active"><a href="{{ url('students') }}">Учащиеся</a></li>--}}
    <li><a href="{{ url('classes') }}" >@lang('welcome.2')</a></li>
    <li class="active">{{$studentTests[0]->lastname.' '.$studentTests[0]->firstname}}</li>


@endsection

@section('content')
    {{--<h3>Индивидуальный код: {{ $studentTests[0]->iin }}</h3>--}}
    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>@lang('welcome.37')</th>
            <th>@lang('welcome.38')</th>
            <th>@lang('welcome.32')</th>
            <th>@lang('welcome.39')</th>
            <th>Дата начала</th>
            <th>Дата завершения</th>
            <th>Последняя активность</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
    @foreach ($studentTests as $test)
        <tr>
            <td>{{ $test->iin }}</td>
            <td>{{ $test->test_pass }}</td>
            <td>{{ $test->test_period }}</td>
            <td>
            @if ($test->id_test_status == 0)
                    @lang('welcome.40')
            @elseif ($test->id_test_status == 1)
                    @lang('welcome.41')
            @elseif ($test->id_test_status >= 2)
                    ///
            @endif
            </td>
            <td>{{ $test->test_start_date_time }}</td>
            <td>{{ $test->test_finish_date_time }}</td>
            <td>{{ $test->last_ping_date_time }}</td>
            <td>
                @if($test->id_test_status == 0)

                @elseif($test->id_test_status == 3)
                    <a class="btn btn-default" href="{{url('/pr2/'.$test->id_test)}}" role="button">@lang('welcome.36')</a>
                @endif

            </td>
        </tr>
    @endforeach
        </tbody>
    </table>
@endsection