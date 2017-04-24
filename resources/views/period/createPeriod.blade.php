{{URL::forceSchema('https')}}
@extends('layouts.index')

@section('nav')
    @parent
    <li><a href="{{ url('period') }}" >@lang('welcome.3')</a></li>
    <li class="active">@lang('welcome.31')</li>
@endsection

@section('title', 'ВОУД СО')


@section('content')
    <div class="row">
        <div class="col-md-12 has-error">
            <label class="control-label text-center"><h2>
                {{$errors->has(0) ? $errors->default->messages(0)[0][0] : ''}}
				
            </h2></label>
        </div>
    </div>
    {!! Form::open(array('url' => '/period', 'method' => 'post', 'id' => 'formPeriod')) !!}
    <div class="row">
        <div class="form-group {{$errors->has('identifier') ? 'has-error' : ''}}">
            {{Form::label('identifier', trans('welcome.32'), array('class' => 'col-md-4 control-label text-right'))}}
            <div class="col-md-8">
                {{ Form::text('identifier', $identifier = null, array('class' => 'form-control input-md', 'placeholder' =>  trans('welcome.32'))) }}
            </div>
        </div>

        <div class="form-group {{$errors->has('lang') ? 'has-error' : ''}}">
            {{Form::label('identifier', trans('welcome.44'), array('class' => 'col-md-4 control-label text-right'))}}
            <div class="col-md-8">
                {{ Form::select('lang', array(1 => 'казахский', 2 => 'русский'), null, ['class' => 'form-control text-right', 'placeholder' =>  trans('welcome.44')]) }}
            </div>
        </div>

        <div class="form-group {{$errors->has('num') || $errors->has('liter')  ? 'has-error' : ''}}">
            {{Form::label('class', trans('welcome.2_2'), ['class' => 'col-md-4 control-label text-right'])}}
            <div class="col-md-8">
                {{ Form::select('class', $classes,  0 , ['class' => 'form-control text-right', 'id' => 'select-classes', 'placeholder' => trans('welcome.2_2').'...']) }}
            </div>
        </div>

        <table class="table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><input type="checkbox" onclick="allcheck();" id="allcb" name="allcb"/></th>
                <th>@lang('welcome.25')</th>
                <th>@lang('welcome.22')</th>
                <th>@lang('welcome.23')</th>
                <th>@lang('welcome.24')</th>
            </tr>
            </thead>
            <tbody id="students">
            </tbody>
        </table>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="num" id="studentsH" value="">
    </div>
    <div class="form-group">
        <label class="col-md-10 control-label" for=""></label>
        <div class="col-md-2">
            <button type="button" class="btn btn-primary" id="add">@lang('welcome.20')</button>
        </div>
    </div>
    {!! Form::close() !!}

    @if($errors->has('identifier') or $errors->has('lang') or $errors->has('num') or $errors->has('liter'))
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
    @if($errors->has('identifier') or $errors->has('lang') or $errors->has('num') or $errors->has('liter'))
        $('#myModal').modal('show');
    @endif
    $("#add").click(
    function(){
    var num =  document.querySelectorAll("input[name=SelectItem]:checked").length;
    var check =  document.querySelectorAll("input[name=SelectItem]:checked");
    var itm = [];
    var strId="";
    for(var i = 0; i < num; i++){
    itm[i] = $(check[i]).val();
    }
    console.log(itm);
    for(var i = 0; i < num; i++){
    strId = strId+itm[i]+'|';
    }
    document.getElementById("studentsH").value=strId.substring(0, strId.length - 1);
    document.getElementById('select-classes').options[0];
    $('#formPeriod').submit();

    });

@endsection