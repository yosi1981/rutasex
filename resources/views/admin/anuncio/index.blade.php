@extends ('layouts.admin1')
@section ('contenido')

@include('admin.anuncio.includes.modalDelete')

            <a href="{{URL::to('/admin/crearAnuncio')}}"><button class="btn btn-success">Crear Anuncio</button></a>
    @include('anuncio.search')


<div class="row">

    <div class="col-lg-12 ccol-md-12 col-sm-12 col-xs-12" >
    
        <div class="table-responsive" id="cuerpo" name="cuerpo">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover" ">
                <thead>
                    <th>Id Anuncio</th>
                    <th>Titulo</th>
                    <th>descripcion</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Final</th>
                    <th>Activo</th>
                    <th>Id Localidad</th>
                    <th>Id Usuario</th>

                </thead>
@if (count($anuncios)>0)
                <tbody>
                    @foreach ($anuncios as $anu)
                    <tr>
                        <td>{{$anu->idanuncio}}</td>
                        <td>{{$anu->titulo}}</td>
                        <td>{{$anu->descripcion}}</td>
                        <td>{{$anu->fechainicio}}</td>
                        <td>{{$anu->fechafinal}}</td>                     
                        <td>{{$anu->activo}}</td>                     
                        <td>{{$anu->NombreLocalidad}}</td>                     
                        <td>
                            <a href="{{URL::to('/admin/Usuario/'.$anu->idusuario.'/edit')}}">
                                {{$anu->NombreUsuario}}
                            </a>
                        </td>                                                 
                        <td>

                            <a href="{{URL::to('/Anuncio/'.$anu->idanuncio.'/edit')}}">
                                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true">
                                </i>
                            </a>

                            <i class="fa fa-camera-retro fa-2x delete-modal " color=#00c0ef data-id="{{$anu->idanuncio}}"></i> 
                            
                        </td>                   
                    </tr>
                    @endforeach
                </tbody>

@else
                <tbody>
                    <tr>
                        <td colspan=5 align="center"><b>No hay resultados en la búsqueda</b></td>

                    </tr>
                </tbody>

@endif
            </table>
            {{$anuncios->links()}}
        </div>

        </div>
    </div>

    <div id='calendar'></div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
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
            header: {
                center: 'title',

            },
            defaultDate: hoy,
            navLinks: false, // can click day/week names to navigate views
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: [
                {
                    title: 'All Day Event',
                    start: '2017-05-01'
                },
                {
                    title: 'Probando',
                    start: '2017-06-01',
                    end: '2017-06-26'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2017-05-09T16:00:00'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2017-05-16T16:00:00'
                },
                {
                    title: 'Conference',
                    start: '2017-05-11',
                    end: '2017-05-13'
                },

                {
                    title: 'Lunch',
                    start: '2017-05-12T12:00:00'
                },
                {
                    title: 'Meeting',
                    start: '2017-05-12T14:30:00'
                },
                {
                    title: 'Happy Hour',
                    start: '2017-05-12T17:30:00'
                },
                {
                    title: 'Dinner',
                    start: '2017-05-12T20:00:00'
                },
                {
                    title: 'Birthday Party',
                    start: '2017-05-13T07:00:00'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2017-05-28'
                }
            ]
        });
        
    });
</script>
<style>


    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }

</style>


<script type="text/javascript">
    $('#searchText').on('keyup',function(){
        $value=$(this).val();      
        $.ajax({
            type : 'get',
            url  : '{{URL::to('/admin/searchAnuncio')}}',
            data : {'searchText' : $value},
            async: true,
            dataType: 'json',
            headers: {
                       'X-CSRF-TOKEN': '{{ csrf_token() }}',
                 },
            success:function(data){
                $('#cuerpo').html(data);
            }
        })
    })
    $(document).on('click','.pagination a',function(e){
        e.preventDefault();
        var page=$(this).attr('href').split('page=')[1];
        getUsuarios(page,$('#searchText').val());
    })
$(document).ready(function() {
        $('.modal').appendTo("body");
        MostrarMensaje();
        });

    function MostrarMensaje()
    {
            $.bootstrapGrowl("{{ \Session::get('seccion_actual') }}", {
              ele: 'body', // which element to append to
              type: 'info', // (null, 'info', 'danger', 'success')
              offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
              align: 'right', // ('left', 'right', or 'center')
              width: 250, // (integer, or 'auto')
              delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
              allow_dismiss: true, // If true then will display a cross to close the popup.
              stackup_spacing: 10 // spacing between consecutively stacked growls.
            });     
    }
    function getAnuncios(page,search)
    {
        var url="{{URL::to('/admin/searchAnuncio')}}";
        $.ajax({
            type : 'get',
            url  : url+'?page='+page,
            data : {'searchText': search}
        }).done(function(data){
            $('#cuerpo').html(data);
        })
    }


        
        $(document).on('click', '.delete-modal', function(){
            $('.id').text($(this).data('id'));
            $('#modal-delete').modal('show');
        })
        $('.modal-footer').on('click', '.delete', function(e) {
            e.preventDefault();
            var url="{{URL::to('/admin/eliminarAnuncio')}}";
          $.ajax({
            type: 'post',
            data: {
              'id': $('.id').text()
            },
            url: url,
            headers: {
                       'X-CSRF-TOKEN': '{{ csrf_token() }}',
                   },
            success: function(data) {
            $('#modal-delete').modal('hide');
            getAnuncios(1,"");
            $('.modal-backdrop').removeClass();
            }
          });
        });
</script>
@endsection