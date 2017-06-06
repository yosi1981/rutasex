       <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover" ">
                <thead>
                    <th>Id</th>
                    <th>Id Pagador</th>
                    <th>Id Pago</th>
                    <th>Fecha</th>
                    <th>Dias</th>
                    <th>Precio</th>
                    <th>Total</th>

                </thead>
@if (count($pagos)>0)
                <tbody>
                    @foreach ($pagos as $pag)
                    <tr>
                        <td>{{$pag->id}}</td>
                        <td>{{$pag->payerID}}</td>
                        <td>{{$pag->paymentID}}</td>
                        <td>{{$pag->fecha_pago}}</td>
                        <td>{{$pag->dias}}</td>                     
                        <td>{{$pag->precio}}</td>                     
                        <td>{{$pag->total}}</td>                                       
         
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
            {{$pagos->links()}}
        </div>
