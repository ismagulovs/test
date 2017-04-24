{{URL::forceSchema('https')}}
@extends('layouts.index')

@section('nav')

@endsection

@section('menu')

@show

@section('title', 'өөөөө')


@section('content')

    <div class="row">
        {!! Form::open(array('url' => '/update_kassa_user', 'method' => 'post', 'id' => 'formClassAdd')) !!}
        <div class="col-md-12 text-center"><h3>Данные ответственого по школе</h3></div>
        <div class="form-group">
            {{Form::label('Last', trans('welcome.37'), array('class' => 'col-md-4 control-label text-right'))}}
            {{Form::label('Last', session('login') ? session('login') : '', array('class' => 'col-md-8 control-label text-left'))}}
        </div>

        <div class="form-group {{$errors->has('fio') ? 'has-error' : ''}}">
            {{Form::label('fio',  trans('welcome.69'), array('class' => 'col-md-4 control-label text-right'))}}
            <div class="col-md-6">
                {{ Form::text('fio', old('fio'), array('class' => 'form-control input-md',
                 'placeholder' =>  trans('welcome.69'))) }}
            </div>
        </div>

        <div class="form-group">
            {{Form::label('obl', 'Область', array('class' => 'col-md-4 control-label text-right'))}}
            <div class="col-md-6">
                @if(session('obls'))
                    {{ Form::select('obl', session('obls'), null, array('class' => 'form-control input-md',
                'id' => 'onObl'))}}
                @endif
            </div>
        </div>

        <div class="form-group ">
            {{Form::label('raion',  'Район', array('class' => 'col-md-4 control-label text-right'))}}
            <div class="col-md-6">
                <select class="form-control text-right" id="onRaion" name="raion">
                    <option selected="selected" value="">район...</option>
                </select>
            </div>
        </div>

        <div class="form-group {{$errors->has('uchZav') ? 'has-error' : ''}}">
            {{Form::label('uchZav',  'Учебное заведение', array('class' => 'col-md-4 control-label text-right'))}}
            <div class="col-md-6" id="school">
                <select class="form-control text-right" name="uchZav">
                    <option selected="selected" value="">учебное заведение...</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-5 control-label" for=""></label>
            <div class="col-md-7">
                {{Form::submit(trans('welcome.20'), array('class' => 'btn btn-primary btn-lg'))}}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addStudent">
        нет учебного заведения в списке
    </button>

    <div class="modal fade bs-example-modal-lg" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                {{ Form::open(array('url' => '/addSchool', 'method' => 'post', 'id' => 'formSchoolAdd')) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Добавление учебного заведения</h4>
                </div>
                <div class="modal-body text-center">
                    <div class="row">

                        <div class="col-md-4 text-right">Область</div>
                        <div class="col-md-8">
                             @if(session('obls'))
                                    {{ Form::select('obl', session('obls'), null, array('class' => 'form-control input-md',
                                'id' => 'onAddObl'))}}
                             @endif
                        </div>

                        <div class="col-md-4 text-right">Район</div>
                        <div class="col-md-8">
                            <select class="form-control text-right" id="onAddRaion" name="raion">
                                <option selected="selected" value="">район...</option>
                            </select>
                        </div>

                        <div class="col-md-4 text-right">Наименование рус</div>
                        <div class="col-md-8">
                            {{ Form::text('name_rus', null, array('class' => 'form-control input-md', 'id'=>'name_rus')) }}
                        </div>

                        <div class="col-md-4 text-right">Наименование каз</div>
                        <div class="col-md-8">
                            {{ Form::text('name_kaz', null, array('class' => 'form-control input-md', 'id'=>'name_kaz')) }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{Form::submit('Добавить', array('class' => 'btn btn-primary '))}}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    @if($errors->has('fio') or $errors->has('uchZav'))
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
    @if($errors->has('fio') or $errors->has('uchZav'))
        $('#myModal').modal('show');
    @endif

    @if(session('status'))
        alert({{session('status')}});
    @endif

    @if($errors->has('obl') or $errors->has('raion') or $errors->has('name_rus') or $errors->has('name_kaz'))
        alert('ошибка');
    @endif

    $("#addSchool").click(function() {
        if(($("#onAddObl").val() != "") && ($("#onAddRaion").val() != "") && ($("#name_rus").val() != "") && ($("#name_kaz").val() != "")){

            $.post('{{ url('addSchool') }}',
                    {
                        id_obl : $("#onAddObl").val(),
                        id_raion : $("#onAddRaion").val(),
                        name_rus : $("#name_rus").val(),
                        name_kaz : $("#name_kaz").val()
                    }, function(data){
                    alert(data);
                    console.log(data);
            });
        }
    });

    $("#onAddObl").change(function() {
            if($("#onAddObl").val() != ""){
                $.post('{{ url('onObl') }}', { id : $("#onAddObl").val() }, function(data){
                    $('#onAddRaion').html(data);
                });
            }
        });

    $("#onObl").change(function() {
        if($("#onObl").val() != ""){
            $.post('{{ url('onObl') }}', { id : $("#onObl").val() }, function(data){
                $('#onRaion').html(data);
            });
        }
    });

    $("#onRaion").change(function() {
        if($("#onRaion").val() != ""){
            $.post('{{ url('onRaion') }}', { id : $("#onRaion").val() }, function(data){
                $('#school').html(data);
            });
        }
    });
@endsection