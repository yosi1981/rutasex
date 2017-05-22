@extends ('layouts.admin')
@section ('contenido')


	
<div class="table-responsive" id="cuerpo" name="cuerpo">

    @include('admin.imagen.includes.nuevaImagen')
    @include('admin.imagen.includes.modal-delete')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
 
                    <div class="panel-body">
                    	<div class="row">
                    		<button data-toggle="tooltip" data-placement="right" title="Subir Imagen" id="btnUploadImagen" name="btnUploadImagen" class="btn btn-success">Subir imagen</button>
                    	</div>
                        <div class="row">
                            @foreach($imagenes as $imagen)
                            <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="/imagenes/thumb_{{$imagen->ficheroimagen}}" alt="{{$imagen->idusuario}}">
                                    <div class="caption">
                                        <h3>{{$imagen->titulo}}</h3>
                                        <button data-toggle="tooltip" data-placement="top" title="Eliminar Elemento" type="button" class="delete-modal btn btn-danger" data-id="{{$imagen->idimagen}}" data-titulo="{{$imagen->titulo}}"><span class="glyphicon glyphicon-remove" aria-hidden="true" ></span></button>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--
   <div style="max-width:900px;margin:0 auto;padding:100px 0;">

        <div style="float:left;padding-top:98px;">
            <div id="thumbnail-slider">
                <div class="inner">
                    <ul>
                        @foreach($imagenes as $imagen)
                        <li>
                            <img class="thumb" src="/imagenes/thumb_{{$imagen->ficheroimagen}}" style="height:auto;" />
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>    
-->
   <div style="max-width:900px;margin:0 auto;padding:100px 0;">

        <div style="float:left;padding-top:98px;">
            <div id="thumbnail-slider">
                <div class="inner">
                    <ul>
                        @foreach($imagenes as $imagen)
                        <li>
                        <img class="thumb" src="/imagenes/{{$imagen->ficheroimagen}}" style="height:auto;" />
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>



<script type="text/javascript">
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();   
            });
			$('#btnUploadImagen').on('click',function(){
				$('#Imagen').modal('show');
			})
    
    		var form=document.getElementById('frmUploadImage');
    		var request=new XMLHttpRequest();

    		form.addEventListener('submit',function(e){
    			e.preventDefault();
    			var formData=new FormData(form);

    			alert(formData);
    			request.open('post','uploadimage');
    			request.addEventListener("load",transferComplete);
    			request.send(formData);


    		})

    		function transferComplete(data){
    			$('#Imagen').modal('hide');
    		}
            $(document).on('click', '.delete-modal', function(){
                    $('.id').text($(this).data('id'));
                    $('#titledelete').text("Desea eliminar la imagen: ".concat($(this).data('titulo')));
                    $('#modal-delete').modal('show');
                })
                $('.modal-footer').on('click', '.delete', function(e) {
                    e.preventDefault();
                    var url="{{URL::to('/admin/eliminarimagen')}}";
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
                    }
                  });
                });
</script>
@endsection
