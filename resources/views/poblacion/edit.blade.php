

		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Editar {{$poblacion->nombre}} de {{$provincia->nombre}}</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">x</span>
					</button>
				</div>
			<div class="alert alert-danger" id="mosError">

			</div>
				<div class="modal-body">		
				<form action="/admin/actualizarlocalidad" method "post" id="frmEditPoblacion">
						<div class="row">
							<div class="col-lg-4 col-sm-4">
								<div class="form-group">
										<label>Id</label>
										<input type="text" name="idlocalidad" class="form-control" value="{{$poblacion->idlocalidad}}" id="idlocalidad" placeholder="idprovincia...">
								</div>
							</div>
						</div>
						<div class="row">
								<div class="col-lg-4 col-sm-4">
									<div class="form-group">
										<label >Nombre</label>
										<input type="text" id="nombre" name="nombre" class="form-control" value="{{$poblacion->nombre}}" placeholder="Nombre...">
						</div>
						<div class="row">
								<div class="col-lg-4 col-sm-4">
									<div class="form-group">
										<label >Id Provincia</label>
										<input type="text" id="idprovincia" name="idprovincia" class="form-control" value="{{$poblacion->idprovincia}}" placeholder="idpoblacion...">
						</div>
				<div class="modal-footer">
					<div class="form-group">
						<button class="guardarEditProblacion btn btn-primary" type="submit">Guardar</button>
						<button type="button" value="save" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</div>
					</form>
				</div>
			</div>
		</div>
