{{URL::forceSchema('https')}}
@extends('layouts.index')

@section('title', 'ВОУД СО')



@section('nav')
    @parent
    <li class="active">@lang('welcome.2')</li>
    <li><a href="{{ url('classes/create') }}"  class="btn btn-info">@lang('welcome.9')</a></li>

@endsection

@section('content')
    <table id="example" class="display table text-center" cellspacing="0" width="100%">
        <thead>
        <tr >
            <th rowspan="2" class="text-center">@lang('welcome.12')</th>
            <th rowspan="2" class="text-center">@lang('welcome.13')</th>
            <th rowspan="2" class="text-center">@lang('welcome.14')</th>
            <th colspan="3" class="text-center">@lang('welcome.15')</th>
            <th rowspan="2" class="text-center"></th>
        </tr>
        <tr>
            <th><span style="font-size: 12px"><b>@lang('welcome.16')</b></span></th>
            <th><span style="font-size: 12px"><b>@lang('welcome.17')</b></span></th>
            <th><span style="font-size: 12px"><b>@lang('welcome.18')</b></span></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($classes as $class)
            <tr>
                <td>{{ $class->num_class }}</td>
                <td>{{ $class->liter_class }}</td>
                <td>{{ $class->count }}</td>
                <td>{{ $class->active_test_period }}</td>
                <td>{{ $class->start_test_period }}</td>
                <td>{{ $class->end_test_period }}</td>
                <td><a class="btn btn-default" href="{{ url('classes/'.$class->num_class.'-'.$class->liter_class) }}" role="button">@lang('welcome.19')</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection