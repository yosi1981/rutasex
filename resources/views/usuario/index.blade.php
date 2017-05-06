@extends ('layouts.admin')
@section ('contenido')

@include('usuario.modalDelete')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

		<h3>Listado de Usuarios 
			<a href="{{URL::action('UsuarioController@CrearUsuario')}}"><button class="btn btn-success">Crear Usuario</button></a>
		</h3>
	</div>
	@include('usuario.search')
</div>

<div class="row">

	<div class="col-lg-12 ccol-md-12 col-sm-12 col-xs-12" >
	
		<div class="table-responsive" id="cuerpo" name="cuerpo">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover" ">
				<thead>
					<th>Id Usuario</th>
					<th>Usuario</th>
					<th>Email</th>
					<th>Activo</th>
					<th>Tipo</th>
					<th>Opciones</th>
				</thead>
@if (count($usuarios)>0)
				<tbody>
					@foreach ($usuarios as $usu)
					<tr>
						<td>{{$usu->id}}</td>
						<td>{{$usu->name}}</td>
						<td>{{$usu->email}}</td>
						<td>{{$usu->activo}}</td>
						<td>{{$usu->stringRol->nombre}}</td>						
						<td>
                             <a href="{{URL::action('UsuarioController@edit',$usu->id)}}">
                                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Editar Usuario">
                                </i>
                            </a>
							<a href="{{URL::action('UsuarioController@IniciarSesion',$usu->id)}}" data-toggle="tooltip" data-placement="right" title="Iniciar sesion como ... {{$usu->name}}"><i class="fa fa fa-bolt fa-2x" ></i></a>
                            <i class="fa fa-camera-retro fa-2x delete-modal " data-toggle="tooltip" data-placement="right" title="Eliminar Usuario" color=#00c0ef data-id="{{$usu->id}}"></i> 
						</td>					
					</tr>
					@endforeach
				</tbody>

@else
				<tbody>
					<tr>
						<td colspan=6 align="center"><b>No hay resultados en la búsqueda</b></td>

					</tr>
				</tbody>

@endif
			</table>
			{{$usuarios->links()}}
		</div>

		</div>
	</div>
</div>
<script type="text/javascript">
	$('#searchText').on('keyup',function(){
		$value=$(this).val();
		$.ajax({
			type : 'get',
			url  : '{{URL::to('/admin/searchUsuario')}}',
			data : {'searchText' : $value},
			async: true,
    		dataType: 'json',
    		headers: {
                       'X-CSRF-TOKEN': '{{ csrf_token() }}',
                 },
			success:function(data){
				$('#cuerpo').html(data);
			}
		})
	})

	$(document).on('click','.pagination a',function(e){
		e.preventDefault();
		var page=$(this).attr('href').split('page=')[1];
		getUsuarios(page,$('#searchText').val());
	})

	function getUsuarios(page,search)
	{
		var url="{{URL::to('/admin/searchUsuario')}}";
		$.ajax({
			type : 'get',
			url  : url+'?page='+page,
			data : {'searchText': search}
		}).done(function(data){
			$('#cuerpo').html(data);
		})
	}


  		$('#btnAddProvincia').on('click',function(){
	    	$('#Provincia').modal('show');
	    })

    	$('#frmProvincia').on('submit',function(e){
    		e.preventDefault();
    		var form=$('#frmProvincia');
    		var formData=form.serialize();
    		var url=form.attr('action');
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
    				alert("llego");
     				$('#Provincia').modal('hide');
    				getUsuarios(1,"");
    			}

    		}).fail(function(data){

    			    		})
    	})

    	
    	$(document).on('click', '.delete-modal', function(){
    		$('.id').text($(this).data('id'));
    		$('#modal-delete').modal('show');
    	})
		$('.modal-footer').on('click', '.delete', function(e) {
			e.preventDefault();
			var url="{{URL::to('/admin/eliminarUsuario')}}";
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
		    $('#modal-delete').modal('hide');
		    getUsuarios(1,"");
		    $('.modal-backdrop').removeClass();
		    }
		  });
		});
</script>
@endsection