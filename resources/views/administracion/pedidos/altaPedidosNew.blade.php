@extends('layouts.app')

@section('publics')
    <script src="{{ asset('js/altaPedidos.js') }}"></script>
    <script src="{{ asset('js/altaPedidosValidar.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/notifCartel.js') }}"></script>
    <script src="{{ asset('js/errorCartel.js') }}"></script>
@endsection
@section('content')
    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" >Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('administracion.menu')}}">Administracion</a></li>
                    <li class="breadcrumb-item"><a href="{{route('pedidos.index')}}">Pedidos</a></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center container-fluid">
        <div class="col-md-10">
            @if (session('error'))
            <div class="">
                <p class="errorjs" style="display:none">{{ session('error') }}</p>
            </div>
            @endif
            @if (session('message'))
                <div class="" role="alert">
                    <p class="alertajs" style="display:none">{{ session('message') }}</p>
                </div>
            @endif
            <div class="card">
                <div class="card-header text-center h2"> {{__('Alta de pedido de cliente') }}</div>
                <div class="card-body">
                    <form action="{{route('pedidos.store')}}" method="POST">
                        @csrf
                        <div class="form-inline row">
                            <label for="cliente" class="col-md-1 col-form-label text-md-left">Cliente</label>

                            <select name="cliente" id="cliente"  class="cliente_id custom-select col-md-2 form-check-input:invalid"> {{--checkear que form-check-input:invalid ande--}}
                                <option data-tokens=="0">Seleccione</option>

                               @foreach ($clientes as $cliente)
                                    <option value="{{$cliente->id}}"> {{$cliente->denominacion}}</option>
                                @endforeach
                            </select>
                            <label for="producto" class="col-md-1 col-form-label text-md-right offset-md-1">Producto</label>

                            <select name="producto" id="producto" class="productos custom-select col-md-2" >

                            </select>

                            <label for="cantidad" class="col-md-1 col-form-label text-md-right offset-md-1">Cantidad</label>

                            <input id="cantidad" type="number" class="form-control col-md-1 mr-5 cantidadjs" placeholder="KG" name="cantidad"  value="{{old('cantidad')}}" required>

                            <a class="btn btn-info" id="btnCalcular">Calcular</a>

                        </div>



                        <div class="form-group row d-flex justify-content-center">
                            <label for="insumosTrazables" class="h2 text-md-left mt-5">Insumos trazables requeridos</label>
                            <table class="table mt-2 col-md-10">
                                <thead>
                                <tr>
                                    <th scope="col">Id insumo</th>
                                    <th scope="col">Nombre Insumo</th>
                                    <th scope="col">Cantidad necesaria</th>
                                    {{--<th scope="col">Cantidad pendiente</th>--}}
                                    <th scope="col">Lote</th>
                                    <th scope="col">Cantidad en stock cliente</th>
                                    <th scope="col">Cantidad a utilizar cliente</th>
                                </tr>
                                </thead>
                                <tbody id="tableInsumosTrazables">
                                <tr>
                                    <th></th>
                                </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="form-group row d-flex justify-content-center">
                        <label for="insumosNoTrazables" class="h2 text-md-left mt-5">Insumos no trazables requeridos</label>

                            <table class="table mt-2 col-md-10">
                                <thead>
                                <tr>
                                    <th scope="col">Id insumo</th>
                                    <th scope="col">Nombre Insumo</th>
                                    <th scope="col">Cantidad necesaria</th>
                                    {{--                                        <th scope="col">Cantidad pendiente</th>--}}
                                    <th scope="col">Cantidad en stock cliente</th>
                                    <th scope="col">Cantidad a utilizar cliente</th>
                                    <th scope="col">Cantidad en stock fábrica</th>
                                    <th scope="col">Cantidad a utilizar fábrica</th>
                                </tr>
                                </thead>
                                <tbody id="tableInsumosNoTrazables">
                                <tr>
                                    <th></th>
                                </tr>
                                </tbody>
                            </table>
                        </div>


                        <button type="submit" class="btn btn-outline-success btn-block col-sm-2 offset-md-9 mt-2">
                            Verificar
                        </button>
                        <div class="form-group row mt-5">
                            <label for="fechaentrega" class="col-md-2 col-form-label text-md-right">Fecha de entrega</label>
                            <input id="fechaentrega" type="date" class="form-control col-md-2 fecha_entregajs"  name="fechaentrega" value="{{old('fechaentrega')}}" required>
                            <p class="ml-5 mt-2 col-md-2">Capacidad disp. día: <span class="" id="capacidad_restante">-</span> tns</p>


                            <label for="precioxkg" class="col-md-1 col-form-label text-md-right">Precio por tn.</label>
                            <input id="precioxkg" type="number" class="form-control col-md-1 preciojs" placeholder="$" value="{{old('precioxkg')}}" name="precioxkg" >
                            <p class="col-3 mt-2">Precio min por tn.: $
                                <span class="">{{$precioFason->precio_por_kilo}}</span> +-
                                <span>${{$precioFason->variacion_admitida * $precioFason->precio_por_kilo}}</span>
                            </p>

                        </div>

                        <div class="form-inline row mt-5">
                            <a href="{{route('pedidos.index')}}" class="btn btn-secondary col-sm-3">Cancelar</a>
                            <button  type="submit" class="btn btn-primary col-sm-3 offset-md-6">Registrar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
