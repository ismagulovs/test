{{URL::forceSchema('https')}}
@extends('layouts.index')

@section('title', 'ВОУД СО')

@section('nav')
    @parent
    <li class="active" ><a href="{{ url('classes') }}">@lang('welcome.2')</a></li>
    <li class="active">{{ $num.'-'.$liter }}</li>
    <li class="active"><a href="{{ url('classes/'.$num.'-'.$liter.'/add') }}" class="btn btn-info">@lang('welcome.27')</a></li>

@endsection

@section('content')
    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th rowspan="2" >@lang('welcome.25')</th>
            <th rowspan="2" >@lang('welcome.22')</th>
            <th rowspan="2" >@lang('welcome.23')</th>
            <th rowspan="2" >@lang('welcome.24')</th>
            <th colspan="3" class="text-center">@lang('welcome.15')</th>
            <th  rowspan="2"></th>
        </tr>
        <tr>
            <th><span style="font-size: 12px"><b>@lang('welcome.16')</b></span></th>
            <th><span style="font-size: 12px"><b>@lang('welcome.17')</b></span></th>
            <th><span style="font-size: 12px"><b>@lang('welcome.18')</b></span></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->iin }}</td>
                <td>{{ $student->lastname }}</td>
                <td>{{ $student->firstname }}</td>
                <td>{{ $student->patronymic }}</td>

                <td>{{ $student->active_test_period }}</td>
                <td>{{ $student->start_test_period }}</td>
                <td>{{ $student->end_test_period }}</td>

                <td>
                @if($student->active_test_period == 0 and $student->start_test_period == 0 and  $student->end_test_period == 0)
                        {{ Form::open(['method' => 'DELETE', 'route' => ['students.destroy', $student->id]]) }}
                        {{ Form::submit(trans('welcome.28'), ['class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                @else
                    <a class="btn btn-default" href="{{ url('students/'.$student->id) }}" role="button">@lang('welcome.33')</a>
                @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection