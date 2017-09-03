@extends ('layouts.main')
@section ('contenido')


<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

		<h3>ANUNCIOS DE LA PROVINCIA 

	
		</h3>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 ccol-md-12 col-sm-12 col-xs-12" >
	
		<div class="table-responsive" id="cuerpo" name="cuerpo">
           <table class="table table-striped table-bordered table-condensed table-hover" ">
                <thead>
                    <th>Id Anuncio</th>
                    <th>Titulo</th>
                    <th>descripcion</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Final</th>
                    <th>Activo</th>
                    <th>Localidad</th>

                </thead>
@if (count($anuncios)>0)
                <tbody>
                    @foreach ($anuncios as $anu)
                    <td>{{$anu->idanuncio}}</td>
                        <td>{{$anu->titulo}}</td>
                        <td>{{$anu->descripcion}}</td>
                        <td>{{$anu->fechainicio}}</td>
                        <td>{{$anu->fechafinal}}</td>                     
                        <td>{{$anu->activo}}</td>                     
                        <td>{{$anu->NombreLocalidad}}</td>                     
                    <tr>
                        

                    </tr>
                    @endforeach
                </tbody>

@else
                <tbody>
                    <tr>
                        <td colspan=5 align="center"><b>No hay resultados en la búsqueda</b></td>

                    </tr>
                </tbody>

@endif
            </table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#searchText').on('keyup',function(){
		$value=$(this).val();
		$.ajax({
			type : 'get',
			url  : '{{URL::to('searchProvincia')}}',
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
		var url="{{URL::to('searchProvincia')}}";
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
			var url="{{URL::to('eliminar')}}";
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