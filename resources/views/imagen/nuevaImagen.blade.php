<div class="modal fade modal-slide-in-right" id="Imagen" aria-hidden="true" role="dialog" >
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Subir Imagen</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">x</span>
					</button>
				</div>
				<div class="modal-body">		
					<form action="uploadimage" enctype="multipart/form-data" id="frmUploadImage">
						<div class="row">
						<!--

						Falta programar el formulario de subir imagenes 

 						-->
				           	<div class="form-group">
				              <label class="col-md-4 control-label">Nuevo Archivo</label>
				              <input type="hidden" name="_token" value="{{ csrf_token() }}">
				              <div class="col-md-6">
				                <input type="file" class="form-control" name="filesUpload[]" multiple >
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

</div>

