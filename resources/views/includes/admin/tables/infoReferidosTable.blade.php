
			<table class="table table-striped table-bordered  table-hover" >
				<thead>
					<h3>ANUNCIOS EN TUS REFERIDOS</h3>
				</thead>
				<tbody>
				@if(count($usuario->Referidos)>0)
				@foreach($usuario->Referidos as $referido)

					<tr>
						<td >
				<div >
				          <div class="box box-success box-solid collapsed-box">
				            <div class="box-header with-border">
				              <h3 class="box-title">{{$referido->id}} {{$referido->Usuario->email}}  {{count($referido->HistorialAnuncios)}} </h3>
							  
							  @if(count($referido->HistorialAnuncios)>0)
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
						<td>NO TIENES NINGUN REFERIDO</td>
					</tr>
					@endif
				</tbody>
			</table>
