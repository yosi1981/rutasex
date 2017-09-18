

		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Nueva Provincia</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">x</span>
					</button>
				</div>
			<div class="alert alert-danger" id="mosError">

			</div>
				<div class="modal-body">		
					<form action="" method="post" id="frmCitaEditar">
						<div class="row">
							<div class="col-lg-4 col-sm-4">Nombre
								<div class="form-group">
									<input type="text" name="nombre" id="nombre" placeholder="Nombre...">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 col-sm-4">Habilitado
								<div class="form-group">
									{!! Form::checkbox('habilitado', '1',true) !!}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 col-sm-4">Id Responsable
								<div class="form-group">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 col-sm-4">Id Responsable
								<div class="form-group">
									<input id="datetimepicker" type="text" >										
								</div>
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" value="save" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Confirmar</button>
										</form>
				</div>
			</div>
		</div>

