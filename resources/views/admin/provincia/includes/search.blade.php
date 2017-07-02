{!! Form::open(array('url'=>'/admin/Provincia','method'=>'GET','autocomplete'=>'off','class'=>'navbar-form navbar-left','role'=>'search')) !!}
					<div class="form-group">

							<input type="text" class="form-control" id="searchText" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
								<span class="material-input"></span>

							<button type="submit" class="btn btn-white btn-round btn-just-icon">
								<i class="material-icons">search</i><div class="ripple-container"></div>
							</button>
					</div>


{{Form::close()}}

