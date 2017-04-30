@extends ('layouts.admin')
@section ('contenido')

<h1>Modificar Usuario</h1>

  <div class="row">
{!!Form::model($anuncio,['method'=>'PATCH','route'=>['Anuncio.update',$anuncio->idanuncio]])!!}
 <div class="row">
    <div class="form-group col-md-4">
      {{ Form::label('titulo', 'Titulo') }}
      {{ Form::text('titulo', $anuncio->titulo, array('placeholder' => 'Introduce el Titulo', 'class' => 'form-control')) }}
    </div>
  </div>
<div class="row">    
    <div class="form-group col-md-4">
      {{ Form::label('descripcion', 'Descripcion') }}
      {{ Form::text('descripcion', $anuncio->descripcion, array('placeholder' => 'Introduce la descripción', 'class' => 'form-control')) }}        
    </div>
  </div>

<div class="row">    
    <div class="form-group col-md-4">
      {{ Form::label('fechainicio', 'Fecha Inicio') }}
      {{ Form::input('date','fechainicio' , $anuncio->fechainicio, ['class'=>'datepicker form-control']) }}
    </div>
  </div>

<div class="row">    
    <div class="form-group col-md-4">
      {{ Form::label('fechafinal', 'Fecha Final') }}
     {{ Form::input('date','fechafinal' , $anuncio->fechafinal, ['class'=>'datepicker form-control']) }}
     </div>
  </div>

<div class="row">    
    <div class="form-group col-md-4">
      {{ Form::label('activo', 'Activo?') }}
      @if($anuncio->activo==1)
          {{Form::checkbox('activo', '1',true)}}
      @else
          {{Form::checkbox('activo', '0',false)}}
      @endif
    </div>
  </div>

<div class="row">    
    <div class="form-group col-md-4">
      {{ Form::label('idlocalidad', 'Id localidad') }}
      {!! Form::select('idlocalidad',$localidades,null, $attributes = array('class'=>'form-control')) !!}
    </div>
</div>

<div class="row">    
    <div class="form-group col-md-4">
      {{ Form::label('idusuario', 'Id Usuario') }}
      {!! Form::select('idusuario',$usuarios,null, $attributes = array('class'=>'form-control')) !!}    
    </div>
  </div>


  {{ Form::button('Actualizar Anuncio', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
  
{{ Form::close() }}

@endsection
