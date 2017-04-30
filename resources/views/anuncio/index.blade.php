@extends ('layouts.admin')
@section ('contenido')

@include('anuncio.modalDelete')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

        <h3>Listado de Anuncios 
            <a href="{{URL::action('AnuncioController@CrearAnuncio')}}"><button class="btn btn-success">Crear Anuncio</button></a>
        </h3>
    </div>
    @include('anuncio.search')
</div>

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
                            <a href="{{URL::action('UsuarioController@edit',$anu->idusuario)}}">
                                {{$anu->NombreUsuario}}
                            </a>
                        </td>                                                 
                        <td>

                            <a href="{{URL::action('AnuncioController@edit',$anu->idanuncio)}}">
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
</div>
<script type="text/javascript">
    $('#searchText').on('keyup',function(){
        $value=$(this).val();      
        $.ajax({
            type : 'get',
            url  : '{{URL::to('searchAnuncio')}}',
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

    function getAnuncios(page,search)
    {
        var url="{{URL::to('searchAnuncio')}}";
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
            var url="{{URL::to('eliminarAnuncio')}}";
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