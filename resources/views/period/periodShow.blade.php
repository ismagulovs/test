{{URL::forceSchema('https')}}
@extends('layouts.index')

@section('title', 'ВОУД СО')

@section('nav')
    @parent
    <li class="active" ><a href="{{ url('period') }}">@lang('welcome.3')</a></li>
    <li class="active">{{$title}}</li>

@endsection

@section('content')

    @if($periods == null) 
        <script type="text/javascript">
            window.location = "{{ url('/period') }}";
        </script>
    @endif

    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>@lang('welcome.37')</th>
            <th>@lang('welcome.38')</th>
            <th>@lang('welcome.22')</th>
            <th>@lang('welcome.23')</th>
            <th>@lang('welcome.24')</th>
            <th>@lang('welcome.2_2')</th>
            <th>@lang('welcome.13')</th>
            <th>@lang('welcome.39')</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($periods as $period)
            <tr>
                <td>{{ $period->iin }}</td>
                <td>{{ $period->test_pass }}</td>
                <td>{{ $period->lastname }}</td>
                <td>{{ $period->firstname }}</td>
                <td>{{ $period->patronymic }}</td>
                <td>{{ $period->num_class }}</td>
                <td>{{ $period->liter_class }}</td>
                <td>
                    @if ($period->id_test_status == 0)
                        Тестирование не проходил
                    @elseif ($period->id_test_status == 1)
                        Начал тестирование
                    @elseif ($period->id_test_status >= 2)
                        Закончил тестирование
                    @endif
                </td>
                <td>
                @if($period->id_test_status == 0)
					{{URL::forceSchema('https')}}
                    {{ Form::open(['method' => 'DELETE', 'route' => ['period.destroy', $period->id_test]]) }}
                    {{ Form::submit('Удалить', ['class' => 'btn btn-danger']) }}
                    {{ Form::close() }}
                @else
                    <a class="btn btn-default" href="{{url('/pr2/'.$period->id_test)}}" role="button">@lang('welcome.36')</a>
                @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection