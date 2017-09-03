@extends ('layouts.admin1')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			@include('includes.admin.tables.infoAnunciosProvinciasDelega')
			@include('includes.admin.tables.infoReferidosTable')
	</div>

</div>

@endsection

