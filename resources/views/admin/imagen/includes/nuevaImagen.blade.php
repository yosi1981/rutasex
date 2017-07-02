<div class="modal " id="Imagen" aria-hidden="true" role="dialog" >
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Subir Imagen</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">x</span>
					</button>
				</div>
				<div class="modal-body">		
					<form action="/admin/uploadimage" enctype="multipart/form-data" id="frmUploadImage">
						<div class="row" align="center">
						<!--

						Falta programar el formulario de subir imagenes 

 						-->

				              <label >Nuevo Archivo</label>

				                
				              <input type="hidden" name="_token" value="{{ csrf_token() }}">
<span class="btn btn-rose btn-round btn-file">
                                                        <span class="fileinput-new"></span>
                                                        
                                                        <input type="hidden" value="" name=""><input type="file" name="filesUpload[]" multiple="">
                                                    <div class="ripple-container"></div></span>
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

