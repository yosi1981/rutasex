


			<table class="table table-striped table-bordered table-condensed table-hover" >
				<thead>
					<h3>ANUNCIOS EN TUS PROVINCIAS DELEGADAS</h3>
				</thead>
				<tbody>
					@foreach($usuario->DatosUsuario->ProvinciasGestionaDelegado as $provDelega)

					<tr>
					<td>{{$provDelega->id}}</td>
					<td>{{$provDelega->nombre}}</td>
					<td>{{count($provDelega->anunciosHistorial->where('iddelegado',$usuario->id))}}</td>
					</tr>
					<tr>
						<td colspan=3>
						<table class="table table-striped table-bordered table-condensed table-hover" >
						<thead>
							
						</thead>
						<tbody>
								@foreach ($provDelega->anunciosHistorial->where('iddelegado',$usuario->id) as $anuncio)
								<tr>
									<td>{{$anuncio->id}}</td>
									<td>{{$anuncio->fecha}}</td>
									<td>{{$anuncio->idanuncio}}</td>
									<td>{{$anuncio->numvisitas}}</td>							
								</tr>		
								@endforeach		
						</tbody>

						</table>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
