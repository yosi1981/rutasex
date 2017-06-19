


			<table class="table table-striped table-bordered table-condensed table-hover" >
				<thead>
					<h3>ANUNCIOS EN TUS PROVINCIAS DELEGADAS</h3>
				</thead>
				<tbody>
					@if(count($usuario->DatosUsuario->ProvinciasGestionaDelegado)>0)
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
								@if(count($provDelega->anunciosHistorial->where('iddelegado',$usuario->id))>0)
										<tr>
											<td>ID</td>
											<td>FECHA</td>
											<td>IDANUNCIO</td>
											<td>NUMVISITAS</td>					
										</tr>
								@foreach ($provDelega->anunciosHistorial->where('iddelegado',$usuario->id) as $anuncio)
								<tr>
									<td>{{$anuncio->id}}</td>
									<td>{{$anuncio->fecha}}</td>
									<td>{{$anuncio->idanuncio}}</td>
									<td>{{$anuncio->numvisitas}}</td>							
								</tr>		
								@endforeach		
								@endif
						</tbody>

						</table>
						</td>
					</tr>
					@endforeach
					@else
					<tr>
						<td>NO ERES DELEGADO DE NINGUNA PROVINCIA</td>
					</tr>
					@endif
				</tbody>
			</table>
