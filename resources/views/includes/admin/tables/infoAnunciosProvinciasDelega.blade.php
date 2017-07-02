
			<table class="table table-striped table-bordered  table-hover" >
				<thead>
					<h3>ANUNCIOS EN TUS PROVINCIAS DELEGADAS</h3>
				</thead>
				<tbody>
				@if(count($usuario->DatosUsuario->ProvinciasGestionaDelegado)>0)
				@foreach($usuario->DatosUsuario->ProvinciasGestionaDelegado as $provDelega)

					<tr>
						<td >
				<div >
				          <div class="box box-success box-solid collapsed-box">
				            <div class="box-header with-border">
				              <h3 class="box-title">

{{$provDelega->id}}   {{$provDelega->nombre}}  {{count($provDelega->anunciosHistorial->where('iddelegado',$usuario->id))}} </h3>
							  
							  @if(count($provDelega->anunciosHistorial->where('iddelegado',$usuario->id))>0)
				              <div class="box-tools pull-right">
				                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
				                </button>
				              </div>
				              @endif
				              <!-- /.box-tools -->
				            </div>
				            <!-- /.box-header -->
				            <div class="box-body">
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
									<td>{{$anuncio->idanuncioDia}}</td>
									<td>{{$anuncio->fecha}}</td>
									<td>{{$anuncio->idanuncio}}</td>
									<td>{{$anuncio->numvisitas}}</td>										
										</tr>	
										@endforeach	
										@endif
								</tbody>

								</table>
				            </div>
				            <!-- /.box-body -->
				          </div>
				          <!-- /.box -->
				        </div>


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


