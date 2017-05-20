{!! Form::open(array('url' => '/pruebaCheckbox1')) !!} 

{!! Form::label('Test-1') !!} {!! Form::checkbox('ch[]', 'value-1', false); !!} 

{!! Form::label('Test-2') !!} {!! Form::checkbox('ch[]', 'value-2', false); !!} 

{!! Form::submit('Click Me!') !!}
{!! Form::close() !!}