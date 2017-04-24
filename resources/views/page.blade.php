{{URL::forceSchema('https')}}
@extends('layouts.index')

@section('title', 'ВОУД СО')

@section('nav')
    @parent
    <li class="active">@lang('welcome.1')</li>
    <li class="active">{{ isset($testOrg) ? $testOrg->name_rus : ' ' }}</li>
    <li class="active">{{ isset($user) ? $user->username : ' ' }}</li>
@endsection

@section('content')
    <h1 class="text-center">{{ isset($testOrg) ? $testOrg->name_rus : ' ' }}</h1>
    <h3 class="text-center">{{ isset($user) ? $user->username : ' ' }}</h3>
@endsection