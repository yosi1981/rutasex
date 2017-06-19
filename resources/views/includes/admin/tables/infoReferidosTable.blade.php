

			<table class="table table-striped table-bordered table-condensed table-hover" >
				<thead>
					<h3>ANUNCIOS DE TUS REFERIDOS</h3>
				</thead>
				<tbody>
					@if(count($usuario->Referidos)>0)
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
								@if(count($referido->HistorialAnuncios)>0)
										<tr>
											<td>ID</td>
											<td>FECHA</td>
											<td>IDANUNCIO</td>
											<td>NUMVISITAS</td>					
										</tr>
									@foreach ($referido->HistorialAnuncios as $anuncioreferido)
										<tr>
											<td>{{$anuncioreferido->idanuncioDia}}</td>
											<td>{{$anuncioreferido->fecha}}</td>
											<td>{{$anuncioreferido->idanuncio}}</td>
											<td>{{$anuncioreferido->numvisitas}}</td>					
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
						<td>NO TIENES REFERIDOS</td>
					</tr>
					@endif
				</tbody>
			</table>
