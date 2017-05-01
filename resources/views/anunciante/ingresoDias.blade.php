@extends ('layouts.admin')
@section ('contenido')

<h1>Ingresos:</h1>

  <div class="row">
 {{ Form::open(array('url' => '/payment','method'=>'GET'), array('role' => 'form')) }}

  <div class="row">
    <div class="form-group col-md-4">
      {{ Form::label('Dias', 'Número de dias: ') }}
      {{ Form::text('Dias', null, array('placeholder' => 'Introduce el número de dias', 'class' => 'form-control')) }}
    </div>
  </div>
  {{ Form::button('Realizar pago', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
  
{{ Form::close() }}

@endsection