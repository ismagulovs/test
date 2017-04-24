{{URL::forceSchema('https')}}
@extends('layouts.index')

@section('nav')
    @parent
    <li><a href="{{ url('students') }}" >Учащиеся</a></li>
    <li class="active">Добавить</li>
@endsection

@section('title', 'ВОУД СО')


@section('content')
    {!! Form::open(array('url' => '/students', 'method' => 'post', 'id' => 'formStudent')) !!}
    <div class="row">
        <div class="form-group {{$errors->has('first_name') ? 'has-error' : ''}}">
            {{Form::label('FirstName', 'Имя', array('class' => 'col-md-2 control-label text-right'))}}
            <div class="col-md-10">
                {{ Form::text('first_name', $first_name = null, array('class' => 'form-control input-md', 'placeholder' => 'Имя',
                'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => $errors->has('first_name') ? $errors->first('first_name') : '')) }}
            </div>
        </div>

        <div class="form-group {{$errors->has('last_name') ? 'has-error' : ''}}">
            {{Form::label('Last Name', 'Фамилия', array('class' => 'col-md-2 control-label text-right'))}}
            <div class="col-md-10">
                {{ Form::text('last_name', $last_name = null, array('class' => 'form-control input-md', 'placeholder' => 'Фамилия',
                'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => $errors->has('last_name') ? $errors->first('last_name') : '')) }}
            </div>
        </div>

        <div class="form-group {{$errors->has('patronymic') ? 'has-error' : ''}}">
            {{Form::label('Patronymic', 'Отчество', array('class' => 'col-md-2 control-label text-right'))}}
            <div class="col-md-10">
                {{ Form::text('patronymic', $last_name = null, array('class' => 'form-control input-md', 'placeholder' => 'Отчество',
                'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => $errors->has('patronymic') ? $errors->first('patronymic') : '')) }}
            </div>
        </div>

        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
            {{Form::label('email', 'Email', array('class' => 'col-md-2 control-label text-right'))}}
            <div class="col-md-10">
                {{Form::email('email', $value = null, array('class' => 'form-control input-md', 'placeholder' => 'Email Address',
                'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => $errors->has('email') ? $errors->first('email') : ''))}}
            </div>
        </div>

        <div class="form-group {{$errors->has('iin') ? 'has-error' : ''}}">
            {{Form::label('IIN', 'ИИН', array('class' => 'col-md-2 control-label text-right'))}}
            <div class="col-md-10">
                {{Form::number('iin', $value = null, array('class' => 'form-control input-md', 'placeholder' => 'ИИН',
                'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => $errors->has('iin') ? $errors->first('iin') : ''))}}
            </div>
        </div>
        <div class="form-group {{$errors->has('num') || $errors->has('liter')  ? 'has-error' : ''}}">
            {{Form::label('class', 'Класс', array('class' => 'col-md-2 control-label text-right'))}}
            <div class="col-md-2">
                {{ Form::select('num', $class['num'] , null, array('class' => 'form-control text-right', 'placeholder' => 'Номер...',
                'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => $errors->has('num') ? $errors->first('num') : '')) }}
            </div>
            <div class="col-md-2">
                {{ Form::select('liter',  $class['liter'], null, array('class' => 'form-control text-right', 'placeholder' => 'Литера...',
                'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => $errors->has('liter') ? $errors->first('liter') : '')) }}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-10 control-label"></label>
            <div class="col-md-2">
                {{Form::submit('Добавить', array('class' => 'btn btn-primary'))}}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection