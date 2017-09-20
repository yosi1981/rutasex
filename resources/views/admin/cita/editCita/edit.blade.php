

		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">{{$cita->idcita}}</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">x</span>
					</button>
				</div>

				<div class="modal-body">		
					<form action="/updateCita" method="post" id="EditCita">
						<div class="row">
							<div class="col-lg-4 col-sm-4">id Cita
								<div class="form-group">
									<input type="text" name="eidcita" id="eidcita" placeholder="id anuncio..." value="{{$cita->idcita}}">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 col-sm-4">id Anuncio
								<div class="form-group">
									<input type="text" name="eidanuncio" id="eidanuncio" placeholder="id anuncio..." value="{{$cita->idanuncio}}">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 col-sm-4">id Usuario
								<div class="form-group">
									<input type="text" name="eidusuario" id="eidusuario" placeholder="id usuario..." value="{{$cita->idusuario}}">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-4 col-sm-4">Hora comienzo
								<div class="form-group">
									<input id="ehoraini" name="ehoraini" value="{{$cita->horaini}}"  type="text" >					
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 col-sm-4">Hora final
								<div class="form-group">
									<input id="ehorafin" name="ehorafin" value="{{$cita->horafin}}"  type="text" >										
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-4 col-sm-4">Hora final
								<div class="form-group">	
								<input id="efecha" name="efecha" value="{{$cita->fecha}}"  type="text" >		      
								</div>
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" id="actualizarCita" value="save" class="btn btn-default" >Guardar</button>
					<button type="button" id="cerrarUpdateCita" value="csave" class="btn btn-default" data-dismiss="modal">Cerrar</button>
										</form>
				</div>
			</div>
		</div>

