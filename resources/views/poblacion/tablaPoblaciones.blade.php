		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id Poblacion</th>
					<th>Nombre</th>
					<th>Opciones</th>
				</thead>
@if (count($poblaciones)>0)
				<tbody>
					@foreach ($poblaciones as $pobla)
					<tr>
						<td>{{$pobla->idlocalidad}}</td>
						<td>{{$pobla->nombre}}</td>
						<td>
						<button id="btnEditarPoblacion" name="btnEditarPoblacion" data-id="{{$pobla->idlocalidad}}" class="editlocalidad btn btn-info">Editar</button></a>
						<button class="delete-modal btn btn-danger" data-id="{{$pobla->idlocalidad}}">Eliminar</button>
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
		</div>
