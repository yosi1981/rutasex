@if(count($anuncio->UserAnunciante)>0)
	@foreach($anuncio->UserAnunciante->Imagenes as $imagen)
		<div class="row">    
	    	<div class="form-group col-md-4">
				<label for="img{{$imagen->idimagen}}"><img src="/imagenes/thumb_{{$imagen->ficheroimagen}}" alt="{{$imagen->idusuario}}"></label>

					
					@if($anuncio->ImagenesAnuncio->pluck('idimagen')->search($imagen->idimagen)===false)
					<input type="checkbox" class="chk " id="img{{$imagen->idimagen}}" name="ch[]" value="{{$imagen->idimagen}}" />
					@else
					<input type="checkbox" class="chk " checked="checked"  id="img{{$imagen->idimagen}}" name="ch[]" value="{{$imagen->idimagen}}" />
					@endif
			</div>
		</div>
	@endforeach
@endif


