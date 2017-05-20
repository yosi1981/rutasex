		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover" ">
				<thead>
					<th>Id Usuario</th>
					<th>Usuario</th>
					<th>Email</th>
					<th>Activo</th>
					<th>Tipo</th>
					<th>Opciones</th>
				</thead>
@if (count($usuarios)>0)
				<tbody>
					@foreach ($usuarios as $usu)
					<tr>
						<td>{{$usu->id}}</td>
						<td>{{$usu->name}}</td>
						<td>{{$usu->email}}</td>
						<td>{{$usu->activo}}</td>
						<td>{{$usu->stringRol->nombre}}</td>						
						<td>
                            <a href="{{URL::action('UsuarioController@edit',$usu->id)}}">
                                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Editar Usuario">
                                </i>
                            </a>
							<a href="{{URL::action('UsuarioController@IniciarSesion',$usu->id)}}" data-toggle="tooltip" data-placement="right" title="Iniciar sesion como ... {{$usu->name}}"><i class="fa fa fa-bolt fa-2x" ></i></a>
                            <i class="fa fa-camera-retro fa-2x delete-modal " data-toggle="tooltip" data-placement="right" title="Eliminar Usuario" color=#00c0ef data-id="{{$usu->id}}"></i> 
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
			{{$usuarios->links()}}
		</div>
