@extends('layouts.app')

@section('content')
    <section class="container">
        <section>
            <div class="bs-example">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('administracion.menu')}}">Administración</a></li>
                        <li class="breadcrumb-item"><a href="{{route('pedidos.index')}}">Gestión de Pedidos</a></li>
                        <li class="breadcrumb-item active">Visualizar pedido</li>
                    </ol>
                </nav>
            </div>

        </section>


        <section>

            <div class="card">
               <div class="card-header text-center h3">Visualizacion de pedido</div>

                <div class="card-body">
                    <div class="form-inline row">
                        <label for="cliente" class="col-md-1 col-form-label text-md-left">Cliente</label>
                        <input type="text" value="{{$pedidosnt->first()->nombre_cliente}}"  class="col-md-2 form-control" readonly>

                        <label for="Producto" class="col-md-1 col-form-label text-md-right offset-md-1">Producto</label>
                        <input type="text" value="{{$pedidosnt->first()->prod}}"  class="col-md-2 form-control" readonly>

                        <label for="fechaentrega"
                               class="col-md-1 col-form-label text-md-right offset-md-1">Fecha de Entrega</label>
                        <input id="fechaentrega" type="text" class="form-control col-md-2 mr-5"
                                name="fechaentrega" value="{{date('d-m-Y',strtotime($pedidosnt->first()->fecha_fabricacion))}}" readonly>
                    </div>
                    <table class="table  mt-3">
                        <thead>
                        <tr>
                            <th scope="col">id insumo</th>
                            <th scope="col">Descripcion</th>
                            {{--si trazable poner lote--}}

                            <th scope="col">Lote</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Dueño</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($pedidosnt as $op)
                                <tr>
                                    <th class="fila">{{$op->prod_id}}</th>
                                    <th class="fila">{{$op->descripcion}}</th>
                                    <th class="fila">{{$op->cant}}</th>


                                    <th class="fila"> -</th>
                                    @if ( $op->cliente_id  == '1')
                                        <th class="fila">Fabrica</th>
                                    @else
                                        <th class="fila">Cliente</th>

                                    @endif

                                </tr>
                            @endforeach

                            @foreach($pedidost as $op)
                                <tr>
                                    <th class="fila">{{$op->gtin}}</th>
                                    <th class="fila">{{$op->descripcion}}</th>
                                    <th class="fila">{{ $op->nro_lote}}</th>
                                    <th class="fila">{{$op->cantidad}}</th>
                                    <th>Cliente</th>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    {{--abajo de la tabla la fecha de entrega y tambien el precio al cual se vende ese producto--}}
                </div>
                <a class="btn btn-secondary btn-sm col-sm-1 align-self-center" href="{{route('pedidos.index')}}">Volver</a>
            </div>

        </section>

    </section>

@endsection
