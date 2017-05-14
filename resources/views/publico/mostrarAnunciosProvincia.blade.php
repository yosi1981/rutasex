@extends ('layouts.main')

@section ('barraizquierda')
@if (count($provincias)>0)
        @foreach ($provincias as $pro)
            @if ($provincia->idprovincia==$pro->idprovincia)
            <li class="selected"><a href="{{URL::action('PrincipalController@mostrarAnuncios',$pro->idprovincia)}}">{{$pro->nombre}}</a>
            <i class="fa fa-angle-left pull-right"></i></li>
            @else
            <li><a href="{{URL::action('PrincipalController@mostrarAnuncios',$pro->idprovincia)}}">{{$pro->nombre}}</a>
            <i class="fa fa-2x fa-angle-left pull-right"></i></li>            
            @endif
        @endforeach
@endif
@endsection

@section ('contenido')

@if (count($anuncios)>0)
    @foreach ($anuncios as $anu)
        <div class="product_box">
        <img src="{{asset('img/p1.gif')}}" alt="" title="" class="prod_image" />
        <div class="product_details">
            <div class="prod_title">{{$anu->titulo}}</div>
            <p>
            {{$anu->descripcion}}
            </p>
            <div class="prod_title">{{$anu->NombreLocalidad}}ahsdfkjhasd</div>
            <a href="details.html" class="details"><img src="{{asset('img/details.gif')}}" alt="" title="" border="0"/></a>
        </div>
        </div>


      @endforeach
@else

        <div class="product_box">
        <img src="{{asset('img/p1.gif')}}" alt="" title="" class="prod_image" />
        <div class="product_details">
            <div class="prod_title">xxxxxx</div>
            <p>
            xxxxxx
            </p>
            <p class="price"><span class="price">xxxxx</span></p>
            <a href="details.html" class="details"><img src="{{asset('img/details.gif')}}" alt="" title="" border="0"/></a>
        </div>
        </div>

@endif

@endsection 