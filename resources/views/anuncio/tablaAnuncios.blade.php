        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover" ">
                <thead>
                    <th>Id Anuncio</th>
                    <th>Titulo</th>
                    <th>descripcion</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Final</th>
                    <th>Activo</th>
                    <th>Localidad</th>
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
