@extends ('layouts.admin1')
@section ('contenido')

<h1>Modificar Usuario Anunciante</h1>

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
      {{ Form::text('nombre',$usuario->name, array('placeholder' => 'Introduce tu nombre', 'class' => 'form-control')) }}        
    </div>
  </div>

  {{ Form::button('Actualizar Usuario', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
  
{{ Form::close() }}

@include('delegado.usuario.editUsuario.includes.edit'.$usuario->stringRol->nombre) 

@endsection
