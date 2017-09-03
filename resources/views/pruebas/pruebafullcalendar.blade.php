@extends ('layouts.admin1')
@section ('contenido')
	<div id='calendar' class="fc fc-unthemed fc-ltr"></div>
	<a href="{{URL::to('/CitasAnuncioFecha/3/2017-08-28')}}"><button class="btn btn-info">Editar</button></a>
<script type="text/javascript">
	$(document).ready(function() {

		$.get('/CitasAnuncioFecha/3/2017-08-28',
			function(data)
			{
		var hoy = new Date();
		var dd = hoy.getDate();
		var mm = hoy.getMonth()+1; //hoy es 0!
		var yyyy = hoy.getFullYear();
		if(dd<10) {
		    dd='0'+dd
		} 

		if(mm<10) {
		    mm='0'+mm
		} 

		hoy = yyyy+'-'+mm+'-'+dd;

		$('#calendar').fullCalendar({

			defaultDate: hoy,
			navLinks: false, // can click day/week names to navigate views
			editable: false,
			eventLimit: false, // allow "more" link when too many events
			events: data
		});
				$('#calendar').fullCalendar('changeView', 'agendaDay');
			});
	});
</script>
<style>


	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}

</style>


@endsection

