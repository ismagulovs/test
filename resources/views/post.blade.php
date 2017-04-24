
    @foreach ($students as $student)
        <tr id="{{$student->id}}">
            <td><input type="checkbox" name="SelectItem" value="{{$student->id}}"/></td>
            <td>{{ $student->iin }}</td>
            <td>{{ $student->lastname }}</td>
            <td>{{ $student->firstname }}</td>
            <td>{{ $student->patronymic }}</td>
        </tr>
    @endforeach
