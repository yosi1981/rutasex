
	                                    	@foreach($usuario->Referidos as $referido)
		                                        @if(count($referido->HistorialAnuncios)>0)	                                
													<div class="card">
									                            <div class="card-header" data-background-color="green">
									                                <h4 class="title">{{$referido->id}} {{$referido->Usuario->email}}</h4>
									                                <p class="category">{{count($referido->HistorialAnuncios)}}</p>
									                            </div>
									                            <div class="card-content table-responsive">
									                                <table class="table">
									                                    <thead class="text-primary">
									                                    	<tr><th>id</th>
									                                    	<th>fecha</th>
									                                    	<th>idanuncio</th>
																			<th>numero visitas</th>
									                                    </tr></thead>
									                                    <tbody>
														@foreach ($referido->HistorialAnuncios as $anuncioreferido)
									                                        <tr>
									                                        	<td>{{$anuncioreferido->idanuncioDia}}</td>
									                                        	<td>{{$anuncioreferido->fecha}}</td>
									                                        	<td>{{$anuncioreferido->idanuncio}}</td>
																				<td>{{$anuncioreferido->numvisitas}}</td>
									                                        </tr>
									                                    </tbody>
									                    @endforeach
									                                </table>
									                            </div>
									                </div>
		                                        @endif
	                                        @endforeach
