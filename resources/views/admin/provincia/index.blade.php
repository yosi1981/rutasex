@extends ('layouts.admin1')
@section ('contenido')


<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

		<h3>Listado de Provincias 
			
				<button id="btnAddProvincia" name="btnAddProvincia" class="btn btn-success">Nuevo</button>
	
		</h3>
		@include('admin.provincia.includes.search')
	</div>
</div>
@include('admin.provincia.nuevaProvincia.nuevaProvincia')
<div class="row">
@include('admin.provincia.nuevaProvincia.modal')
	<div class="col-lg-12 ccol-md-12 col-sm-12 col-xs-12" >
	
		<div class="table-responsive" id="cuerpo" name="cuerpo">
			<table class="table table-striped table-bordered table-condensed table-hover" >
				<thead>
					<th>Id Provincia</th>
					<th>Nombre</th>
					<th>Habilitado</th>
					<th>Responsable</th>
					<th>Opciones</th>
				</thead>
				<tbody>
					@foreach ($provincias as $provi)
					<tr>
						<td>{{$provi->idprovincia}}</td>
						<td>{{$provi->nombre}}</td>
						<td>{{$provi->habilitado}}</td>
						<td>
							<a href="{{URL::action('UsuarioController@edit',$provi->idresponsable)}}">
								{{$provi->NombreUsuario}}
							</a>
						</td>
						<td>
							<a href="{{URL::action('ProvinciaController@edit',$provi->idprovincia)}}"><button class="btn btn-info">Editar</button></a>
							@if ($provi->habilitado==1) 
								<button class="delete-modal btn btn-warning" data-id="{{$provi->idprovincia}}">DESHABILITAR</button>
							@else
								<button class="delete-modal btn btn-success" data-id="{{$provi->idprovincia}}">HABILITAR</button>
							@endif
						</td>					
					</tr>
					@endforeach
				</tbody>
			</table>
			{{$provincias->links()}}
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#searchText').on('keyup',function(){
		$value=$(this).val();
		$.ajax({
			type : 'get',
			url  : '{{URL::to('/admin/searchProvincia')}}',
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
		getProvincias(page,$('#searchText').val());
	})

	function getProvincias(page,search)
	{
		var url="{{URL::to('/admin/searchProvincia')}}";
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
    				getProvincias(1,"");
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
			var url="{{URL::to('/admin/eliminarProvincia')}}";
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
		    getProvincias(1,"");
		    $('.modal-backdrop').removeClass();
		    }
		  });
		});
</script>
@endsection