@if(count($anuncio->UserAnunciante)>0)

<select class="image-picker" multiple="multiple" name="ch[]">

	@foreach($anuncio->UserAnunciante->Imagenes as $imagen)

	@if($anuncio->ImagenesAnuncio->pluck('idimagen')->search($imagen->idimagen)===false)
  			<option data-img-src="http://localhost:8000/imagenes/thumb_{{$imagen->ficheroimagen}}" value="{{$imagen->idimagen}}">{{$imagen->titulo}}</option>
	@else
  			<option data-img-src="http://localhost:8000/imagenes/thumb_{{$imagen->ficheroimagen}}" value="{{$imagen->idimagen}}">{{$imagen->titulo}}</option>
	@endif
	@endforeach
</select>	
    <script>
    $(function() {
      $(".image-picker").imagepicker();
      $(".image-picker").val({!! json_encode($anuncio->ImagenesAnuncio->pluck('idimagen')->toArray()) !!});
      $(".image-picker").data('picker').sync_picker_with_select();
       });
 

    </script>
@endif



