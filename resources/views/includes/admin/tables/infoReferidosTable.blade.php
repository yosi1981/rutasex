

			<table class="table table-striped table-bordered table-condensed table-hover" >
				<thead>
					<h3>ANUNCIOS DE TUS REFERIDOS</h3>
				</thead>
				<tbody>
					@foreach($usuario->Referidos as $referido)

					<tr>
					<td>{{$referido->id}}</td>
					<td>{{$referido->Usuario->email}}</td>
					<td>{{count($referido->HistorialAnuncios)}}</td>
					</tr>
					<tr>
						<td colspan=3>
							<table class="table table-striped table-bordered table-condensed table-hover" >
							<thead>
								
							</thead>
							<tbody>
								@foreach ($referido->HistorialAnuncios as $anuncioreferido)
									<tr>
										<td>{{$anuncioreferido->id}}</td>
										<td>{{$anuncioreferido->fecha}}</td>
										<td>{{$anuncioreferido->idanuncio}}</td>
										<td>{{$anuncioreferido->numvisitas}}</td>							
									</tr>
								@endforeach						
							</tbody>

							</table>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
