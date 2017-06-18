		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover" ">
				<thead>
					<th>Id Provincia</th>
					<th>Nombre</th>
					<th>Habilitado</th>
					<th>Responsable</th>
					<th>Opciones</th>
				</thead>
@if (count($provincias)>0)
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

@else
				<tbody>
					<tr>
						<td colspan=5 align="center"><b>No hay resultados en la búsqueda</b></td>

					</tr>
				</tbody>

@endif
			</table>
			{{$provincias->links()}}
		</div>
