@extends ('layouts.admin')
@section ('contenido')

<h1>Crear Usuarios</h1>

  <div class="row">
 {{ Form::open(array('url' => '/admin/NuevoUsuario','method'=>'POST'), array('role' => 'form')) }}

  <div class="row">
    <div class="form-group col-md-4">
      {{ Form::label('email', 'Dirección de E-mail') }}
      {{ Form::text('email', null, array('placeholder' => 'Introduce tu E-mail', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-4">
      {{ Form::label('nombre', 'Nombre completo') }}
      {{ Form::text('nombre', null, array('placeholder' => 'Introduce tu nombre', 'class' => 'form-control')) }}        
    </div>
  </div>
  <div class="row">
    <div class="form-group col-md-4">
      {{ Form::label('password', 'Contraseña') }}
      {{ Form::password('password', array('class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-4">
      {{ Form::label('password_confirmation', 'Confirmar contraseña') }}
      {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
    </div>
  </div>
  <div class="row">    
    <div class="form-group col-md-4">
      {{ Form::label('idTipousuario', 'TipoUsuario') }}
      {!! Form::select('idTipousuario',$TiposUsuario,null, $attributes = array('class'=>'form-control')) !!}
    </div>
  </div>
  {{ Form::button('Crear usuario', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
  
{{ Form::close() }}

@endsection
