

			<table class="table table-striped table-bordered table-condensed table-hover" >
				<thead>
					<h3>ANUNCIOS EN TUS PROVINCIAS</h3>
				</thead>
				<tbody>
				@foreach($usuario->DatosUsuario->ProvinciasGestionaAdminProv as $provGestiona)

					<tr>
					<td>{{$provGestiona->id}}</td>
					<td>{{$provGestiona->nombre}}</td>
					<td>{{count($provGestiona->anunciosHistorial->where('idadminPro',$usuario->id))}}</td>
					</tr>
					<tr>
						<td colspan=3>
						<table class="table table-striped table-bordered table-condensed table-hover" >
						<thead>
							
						</thead>
						<tbody>
								@foreach ($provGestiona->anunciosHistorial->where('idadminPro',$usuario->id) as $anuncio)
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
