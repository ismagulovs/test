{{URL::forceSchema('https')}}
@extends('layouts.index')

@section('nav')
    @parent
    <li><a href="{{ url('classes') }}" >@lang('welcome.2')</a></li>
    <li><a href="{{ url('classes/create') }}" >@lang('welcome.9')</a></li>
    <li class="active">@lang('welcome.21')</li>
@endsection

@section('title', 'ВОУД СО')


@section('content')
    <div class="row">
            {!! Form::open(array('url' => '/class/add', 'method' => 'post', 'id' => 'formClassAdd')) !!}
            <div class="col-md-12 text-center"><h3>
            {{ isset($numClass) && isset($literClass) ? $numClass.' "'.$literClass.'"' : ''}}
                    @lang('welcome.2_2')
            </h3></div>

        <div class="form-group {{$errors->has('last_name') ? 'has-error' : ''}}">
            {{Form::label('Last Name', trans('welcome.22'), array('class' => 'col-md-2 control-label text-right'))}}
            <div class="col-md-10">
                {{ Form::text('last_name', $last_name = null, array('class' => 'form-control input-md', 'placeholder' => trans('welcome.22'))) }}
            </div>
        </div>

        <div class="form-group {{$errors->has('first_name') ? 'has-error' : ''}}">
            {{Form::label('FirstName',  trans('welcome.23'), array('class' => 'col-md-2 control-label text-right'))}}
            <div class="col-md-10">
                {{ Form::text('first_name', $first_name = null, array('class' => 'form-control input-md', 'placeholder' =>  trans('welcome.23'))) }}
            </div>
        </div>

        <div class="form-group {{$errors->has('patronymic') ? 'has-error' : ''}}">
                {{Form::label('Patronymic', trans('welcome.24'), array('class' => 'col-md-2 control-label text-right'))}}
                <div class="col-md-10">
                    {{ Form::text('patronymic', $last_name = null, array('class' => 'form-control input-md', 'placeholder' => trans('welcome.24'))) }}
                </div>
            </div>

            {{ Form::hidden('num', $numClass) }}
            {{ Form::hidden('liter', $literClass) }}

            <div class="form-group">
                <label class="col-md-5 control-label" for=""></label>
                <div class="col-md-7">
                    {{Form::submit(trans('welcome.20'), array('class' => 'btn btn-primary btn-lg'))}}
                </div>
            </div>

        <table class="table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>@lang('welcome.25')</th>
                <th>@lang('welcome.22')</th>
                <th>@lang('welcome.23')</th>
                <th>@lang('welcome.24')</th>
            </tr>
            </thead>
            <tbody>
               @foreach ($students as $student)
                   <tr>
                    <td>{{ $student->iin }}</td>
                    <td>{{ $student->lastname }}</td>
                    <td>{{ $student->firstname }}</td>
                    <td>{{ $student->patronymic }}</td>
                   </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ url('classes') }}" class="btn btn-primary btn-lg" role="button">@lang('welcome.26')</a>
    </div>
    {!! Form::close() !!}

    @if($errors->has('last_name') or $errors->has('first_name') or $errors->has('patronymic'))
        <div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm alert-danger" role="document">
                <div class="modal-content">
                    <div class="modal-header alert alert-danger">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">ERROR</h4>
                    </div>
                    <div class="modal-body text-center">
                        <h4>{{$errors->first()}}</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('js')
    @if($errors->has('last_name') or $errors->has('first_name') or $errors->has('patronymic'))
        $('#myModal').modal('show');
    @endif

@endsection