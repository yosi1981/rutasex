@extends ('layouts.admin1')
@section ('contenido')
	<div class="row">
		@include('poblacion.modal-delete')
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Provincia: {{$provincia->nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif
			@include('poblacion.nuevaPoblacion')
	
			{!!Form::model($provincia,['method'=>'PATCH','route'=>['Provincia.update',$provincia->idprovincia]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" class="form-control" value="{{$provincia->nombre}}" placeholder="Nombre...">
			</div>
			<div class="form-group">
				@if ($provincia->habilitado=='1')
					{!! Form::checkbox('habilitado', '1',true) !!}
				@else
					{!! Form::checkbox('habilitado', '0',false) !!}
				@endif
			</div>
			<div class="form-group">
				<label for="idresponsable">Delegado</label>
				{!! Form::select('iddelegado',$delegados,$delegado,$attributes = array('class'=>'form-control'))!!}
			</div>
			<div class="form-group">
				<label for="idresponsable">Administrador</label>
				{!! Form::select('idadmPro',$admPros,$admPro,$attributes = array('class'=>'form-control'))!!}
			</div>
			<div class="form-group">
				<button class="btn btn-success" type="submit">Guardar</button>
				<button class="btn btn-primary" type="reset">Limpiar</button>
				<a href="Provincia"><button class="btn btn-info">Volver</button></a>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
	<div class="row">
	<div class="col-lg-12 ccol-md-12 col-sm-12 col-xs-12" id="cuerpo">
		<div class="table-responsive" >
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id Poblacion</th>
					<th>Nombre</th>
				    <th>acciones</th>
				</thead>
				@foreach ($poblaciones as $pobla)
				<tr>
					<td>{{$pobla->idlocalidad}}</td>
					<td>{{$pobla->nombre}}</td>		
					<td>
						<button id="btnEditarPoblacion" name="btnEditarPoblacion" data-id="{{$pobla->idlocalidad}}" class="editlocalidad btn btn-info">Editar</button></a>
						<button class="delete-modal btn btn-danger" data-id="{{$pobla->idlocalidad}}">Eliminar</button>
					</td>			
				</tr>
				@endforeach
			</table>
		</div>
	</div>
	<button name="btnAddPoblacion" id="btnAddPoblacion" class="btn btn-warning" data-id="{{$provincia->idprovincia}}">Nuevo</button></a>
	<div class="modal fade modal-slide-in-right" id="mdlEditarPoblacion" aria-hidden="true" role="dialog" >
	</div>
</div>
<script>
		function getLocalidades()
		{
			var url="{{URL::to('/admin/getPoblaciones')}}";
			$.ajax({
				type : 'get',
				url  : url+'?id='+{{$provincia->idprovincia}},
			}).done(function(data){
				$('#cuerpo').html(data);
			})
		}
  		$('#btnAddPoblacion').on('click',function(){
  			$('#idprovioculto').val($(this).data('id'));
	    	$('#Poblacion').modal('show');
	    })
   		$('#frmPoblacion').on('submit',function(e){
    		e.preventDefault();
    		var form=$('#frmPoblacion');
    		var formData=form.serialize();
    		var url="{{URL::to('/admin/nuevaPoblacion')}}";
    		$.ajax({
    			type:'post',
    			url: url,
    			data: formData,
    			async: true,
    			dataType: 'json',
    			headers: {
                       'X-CSRF-TOKEN': '{{ csrf_token() }}',
                   },
    			success:function(data){
    				getLocalidades();
    				$('#Poblacion').modal('hide');
    			}

    		}).fail(function(data){

    			    		})
    	})	    

    	$(document).on('click', '.editlocalidad', function(){
	    	var url="{{URL::to('/admin/editarlocalidad')}}";
	    	var id=$(this).data('id')
    		$.ajax({
    			type:'post',
    			url: url,
    			data: {		    
		      		'id': id
		    	},
    			async: true,
    			dataType: 'json',
    			headers: {
                       'X-CSRF-TOKEN': '{{ csrf_token() }}',
                   },
    			success:function(data){
    				$('#mdlEditarPoblacion').html(data);
    				$('#mdlEditarPoblacion').modal('show');
    			}

    		}).fail(function(data){

    			    		})
	    })
		$('#mdlEditarPoblacion').on('submit',function(e){
			e.preventDefault();
			var url="{{URL::to('/admin/actualizarlocalidad')}}";
   			var form=$('#frmEditPoblacion');
    		var formData=form.serialize();
		  $.ajax({
		    type: 'post',
		    url: url,
   			data: formData,
    		async: true,
    		dataType: 'json',
   			headers: {
                       'X-CSRF-TOKEN': '{{ csrf_token() }}',
                   },
		    success: function(data) {
		    	getLocalidades();
		    $('#mdlEditarPoblacion').modal('hide');
		    }
		  });
		}); 

    	$(document).on('click', '.delete-modal', function(){
    		$('.id').text($(this).data('id'));
    		$('#modal-delete').modal('show');
    	})
		$('.modal-footer').on('click', '.delete', function(e) {
			e.preventDefault();
			var url="{{URL::to('/admin/eliminarlocalidad')}}";
		  $.ajax({
		    type: 'post',
		    data: {
		      'id': $('.id').text()
		    },
		    url: url,
   			headers: {
                       'X-CSRF-TOKEN': '{{ csrf_token() }}',
                   },
		    success: function(data) {
		    	getLocalidades();
		    $('#modal-delete').modal('hide');
		    }
		  });
		});
  </script>
@endsection