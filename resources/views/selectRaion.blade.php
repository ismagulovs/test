
@foreach($raion as $item)
    {{$raions[$item->id_raion] = $item->name_rus;}}
@endforeach
 }}
<div class="col-md-2">
    {{ Form::select('liter', $raions, null,  array('class' => 'form-control text-right',
    'placeholder' => trans('welcome.13'), 'id' => 'onRaion')) }}
</div>