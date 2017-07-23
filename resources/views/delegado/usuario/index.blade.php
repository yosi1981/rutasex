@extends ('layouts.admin1')
@section ('contenido')

@include('delegado.usuario.includes.modalDelete')

			<a href="{{URL::action('UsuarioController@CrearUsuario')}}"><button class="btn btn-success">Crear Usuario</button></a>

	@include('delegado.usuario.includes.search')


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
						<td>
                             <a href="{{URL::to('/delegado/Usuario/'.$usu->id.'/edit')}}">
                                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Editar Usuario">
                                </i>
                            </a>
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
		alert('activado');
		$.ajax({
			type : 'get',
			url  : '{{URL::to('/delegado/searchUsuario')}}',
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
		var url="{{URL::to('/delegado/searchUsuario')}}";
		$.ajax({
			type : 'get',
			url  : url+'?page='+page,
			data : {'searchText': search}
		}).done(function(data){
			$('#cuerpo').html(data);
		})
	}



    	$(document).on('click', '.delete-modal', function(){
    		$('.id').text($(this).data('id'));
    		$('#modal-delete').modal('show');
    	})
		$('.modal-footer').on('click', '.delete', function(e) {
			e.preventDefault();
			var url="{{URL::to('/delegado/eliminarUsuario')}}";
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