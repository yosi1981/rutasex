@extends ('layouts.admin1')
@section ('contenido')
<div class="modal fade modal-slide-in-right" id="crearCita" aria-hidden="true" role="dialog" >
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">{{$anuncio->idanuncio}}</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">x</span>
					</button>
				</div>

				<div class="modal-body">		
					<form action="{{route('cita.guardar')}}" method="post" id="CrearCita">
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
									<input id="horaini" value="05:06"  type="text" >					
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 col-sm-4">Hora final
								<div class="form-group">
									<input id="horafin" value="05:06"  type="text" >										
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-4 col-sm-4">Hora final
								<div class="form-group">	
								<input id="fecha" value="2014/03/15"  type="text" >		      
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
	<div id='calendar' class="fc fc-unthemed fc-ltr"></div>
	<input id="datetimepicker" type="text" value="2014/03/15 05:06">					




<script type="text/javascript">
	$(document).ready(function() {

		idanuncio={{$anuncio->idanuncio}};
		$('.modal').appendTo("body");
		$.get('/CitasAnuncio/'+idanuncio,
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
			events: data,

   eventClick: function(calEvent, jsEvent, view) {

        alert('Event: ' + calEvent.title);
        alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
        alert('View: ' + view.name);

 

    },
    dayClick: function(date, jsEvent, view) {

        $.get('/nuevaCita/'+idanuncio,
        	function(data){
        		
        		$('#crearCita').html(data);
				$('#horaini').datetimepicker({
		  			datepicker:false,
		  			format:'H:i'
				});
				$('#horafin').datetimepicker({
		  			datepicker:false,
		  			format:'H:i'
				});
				$('#fecha').datetimepicker({
		  			timepicker:false,
		  			format:'Y/m/d'
				});
  		$('#prueba').on('click',function(e){
  			e.preventDefault();
    		var form=$('#CCita');
    		var formData=form.serialize();

    		var url=form.attr('action');
    		alert(url);
    		$.ajax({
    			type:'post',
    			url: url,
    			data: formData,
    			async: true,
    			dataType: 'json',
    			headers: {
                       'X-CSRF-TOKEN': '{{ csrf_token() }}',
                   },
    			success:function(data){			
    				alert(data['idcita']);
     				$('#crearCita').modal('hide');
					$('#calendar').fullCalendar('renderEvent',
            {
            	id:data['idcita'],
                title: 'title',
                start: data['fecha']+" "+data['horaini'],
                end: data['fecha']+" "+data['horafin'],
                allDay: false
            },
            true // make the event "stick"
        );
    			}

    		}).fail(function(data){

    			    		})
	    });


				$('#crearCita').modal('show');
        	});
		}
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

