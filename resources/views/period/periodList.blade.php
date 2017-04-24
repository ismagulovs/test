{{URL::forceSchema('https')}}
@extends('layouts.index')

@section('title', 'ВОУД СО')



@section('nav')
    @parent
    <li class="active">@lang('welcome.3')</li>
    <li><a href="{{ url('period/create') }}"  class="btn btn-info">@lang('welcome.31')</a></li>


@endsection

@section('content')
    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>@lang('welcome.32')</th>
            <th>@lang('welcome.12')</th>
            <th>@lang('welcome.13')</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($periods as $period)
            <tr>
                <td>{{ $period->test_period }}</td>
                <td>{{ $period->num_class }}</td>
                <td>{{ $period->liter_class }}</td>
                <td>
                    <a class="btn btn-default" href="./period/{{$period->test_period}}" role="button">@lang('welcome.33')</a>
                    <a class="btn btn-default" href="./pr1/{{$period->test_period}}" role="button">@lang('welcome.34')</a>
                    <a href="{{ url('pr3/'.$period->test_period) }}"  class="btn btn-default">@lang('welcome.35')</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection