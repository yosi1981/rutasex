

		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">{{$anuncio->idanuncio}}</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">x</span>
					</button>
				</div>

				<div class="modal-body">		
					<form action="/guardarNuevaCita" method="post" id="CCita">
						<div class="row">
							<div class="col-lg-4 col-sm-4">id Anuncio
								<div class="form-group">
									<input type="text" name="idanuncio" id="idanuncio" placeholder="id anuncio..." value="{{$anuncio->idanuncio}}">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 col-sm-4">id Usuario
								<div class="form-group">
									<input type="text" name="idusuario" id="idusuario" placeholder="id usuario..." value="{{Auth::user()->id}}">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-4 col-sm-4">Hora comienzo
								<div class="form-group">
									<input id="horaini" name="horaini" value="05:06"  type="text" >					
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 col-sm-4">Hora final
								<div class="form-group">
									<input id="horafin" name="horafin" value="05:06"  type="text" >										
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-4 col-sm-4">Hora final
								<div class="form-group">	
								<input id="fecha" name="fecha" value="2014/03/15"  type="text" >		      
								</div>
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" id="prueba" value="save" class="btn btn-default" >Guardar</button>
					<button type="button" id="cerrar" value="csave" class="btn btn-default" data-dismiss="modal">Cerrar</button>
										</form>
				</div>
			</div>
		</div>

