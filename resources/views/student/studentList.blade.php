{{URL::forceSchema('https')}}
@extends('layouts.index')

@section('title', 'ВОУД СО')



@section('nav')
    @parent
    <li class="active">Учащиеся</li>
    <li><a href="{{ url('students/create') }}"  class="btn btn-info">Добавить</a></li>


@endsection

@section('content')
    <table id="example" class="ui celled table" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th rowspan="2">Идентификатор</th>
            <th rowspan="2">Фамилия</th>
            <th rowspan="2">Имя</th>
            <th rowspan="2">Отчество</th>
            <th rowspan="2">email</th>
            <th rowspan="2">нрмер</th>
            <th rowspan="2">литера</th>
            <th colspan="3">количество</th>
            <th rowspan="2"></th>
        </tr>
        <tr>
            <th><span style="font-size: 12px"><b>активных</b></span></th>
            <th><span style="font-size: 12px"><b>начатых</b></span></th>
            <th><span style="font-size: 12px"><b>завершенных</b></span></th>
        </tr>
        </thead>
        <tbody class="text-center">
    @foreach ($students as $student)
        <tr>
            <td>{{ $student->iin }}</td>
            <td>{{ $student->lastname }}</td>
            <td>{{ $student->firstname }}</td>
            <td>{{ $student->patronymic }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->num_class }}</td>
            <td>{{ $student->liter_class }}</td>
            <td>{{ $student->active_test }}</td>
            <td>{{ $student->start_test }}</td>
            <td>{{ $student->end_test }}</td>
            <td>
                @if($student->active_test == 0 and $student->start_test == 0 and  $student->end_test == 0)
                    {{ Form::open(['method' => 'DELETE', 'route' => ['students.destroy', $student->id]]) }}
                    {{ Form::submit('Удалить', ['class' => 'btn btn-danger']) }}
                    {{ Form::close() }}
                @else
                    <a class="btn btn-default" href="{{ url('students/'.$student->id) }}" role="button">Подробнее</a>
                @endif
            </td>
        </tr>
    @endforeach
        </tbody>
    </table>
@endsection