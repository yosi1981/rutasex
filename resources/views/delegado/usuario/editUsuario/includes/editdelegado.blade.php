<h1>Modificar Usuario {{$usuario->stringRol->nombre}}</h1>

  <div class="row">
{!!Form::model($usuario,['method'=>'PATCH','route'=>['Usuario.update',$usuario->id]])!!}
 <div class="row">
    <div class="form-group col-md-4">
      {{ Form::label('email', 'Dirección de E-mail') }}
      {{ Form::text('email', $usuario->email, array('placeholder' => 'Introduce tu E-mail', 'class' => 'form-control')) }}
    </div>
  </div>
<div class="row">    
    <div class="form-group col-md-4">
      {{ Form::label('nombre', 'Nombre completo') }}
      @if ($usuario->DatosUsuario!=null)
      {{ Form::text('nombre',$usuario->DatosUsuario->nombre, array('placeholder' => 'Introduce tu nombre', 'class' => 'form-control')) }}        
      @else
      {{ Form::text('nombre',null, array('placeholder' => 'Introduce tu nombre', 'class' => 'form-control')) }}        
      @endif
  </div>

  {{ Form::button('Actualizar Usuario', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
  
{{ Form::close() }}