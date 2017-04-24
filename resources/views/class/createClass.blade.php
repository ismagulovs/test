{{URL::forceSchema('https')}}
@extends('layouts.index')

@section('nav')
    @parent
    <li><a href="{{ url('classes') }}" >@lang('welcome.2')</a></li>
    <li class="active">@lang('welcome.9')</li>
@endsection

@section('title', 'ВОУД СО')


@section('content')
    @if($errors->has('num') or $errors->has('liter'))
        <div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm alert-danger" role="document">
                <div class="modal-content">
                    <div class="modal-header alert alert-danger">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">ERROR</h4>
                    </div>
                    <div class="modal-body text-center">
                        <h4>Не все поля заполнены!</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 has-error text-right"><label class="control-label">
            </label> </div>
        {!! Form::open(array('url' => '/class_flash', 'method' => 'post', 'id' => 'formClass')) !!}
            <div class="col-md-12">
                <div class="form-group {{$errors->has('num') || $errors->has('liter')  ? 'has-error' : ''}}">
                    {{Form::label('class', trans('welcome.2_2'), array('class' => 'col-md-2 control-label text-right'))}}
                    <div class="col-md-2">
                        {{ Form::select('num', $class['num'] , null, array('class' => 'form-control text-right',
                         'placeholder' => trans('welcome.12'))) }}
                    </div>
                    <div class="col-md-2">
                        {{ Form::select('liter',  $class['liter'], null, array('class' => 'form-control text-right',
                        'placeholder' => trans('welcome.13'))) }}
                    </div>
                    <div class="col-md-2">
                        {{Form::submit(trans('welcome.20'), array('class' => 'btn btn-primary'))}}
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>

@endsection

@section('js')
    @if($errors->has('num') or $errors->has('liter'))
        $('#myModal').modal('show');
    @endif
@endsection