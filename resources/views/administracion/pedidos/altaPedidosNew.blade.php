@extends('layouts.app')

@section('publics')
    <script src="{{ asset('js/altaPedidos.js') }}"></script>
    <script src="{{ asset('js/altaPedidosValidar.js') }}"></script>
    <script src="{{ asset('js/altaPedidosPrevenirInput.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/notifCartel.js') }}"></script>
    <script src="{{ asset('js/errorCartel.js') }}"></script>
@endsection
@section('content')
    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('administracion.menu')}}">Administración</a></li>
                    <li class="breadcrumb-item"><a href="{{route('pedidos.index')}}">Gestión de Pedidos</a></li>
                    <li class="breadcrumb-item active">Nuevo pedido</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center container-fluid">
        <div class="col-md-10">
            @if (session('error'))
                <div class="">
                    <p class="errorjs" style="display:none">{{ session('error') }}

                    </p>
                </div>
            @endif
            @if (session('message'))
                <div class="" role="alert">
                    <p class="alertajs" style="display:none">{{ session('message') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="">
                    <p class="errorjs" style="display:none">{{ $errors->first() }}</p>
                </div>
            @endif
            <div class="card">
                <div class="card-header text-center h2"> {{__('Alta de pedido de cliente') }}</div>
                <div class="card-body">
                    <form action="{{route('pedidos.store')}}" method="POST">
                        @csrf
                        <div class="form-inline row">
                            <label for="cliente" class="col-md-1 col-form-label text-md-left">Cliente</label>

                            <select name="cliente" id="cliente"
                                    class="cliente_id custom-select col-md-2 form-check-input:invalid"
                                    value="{{old("cliente")}}"> {{--checkear que form-check-input:invalid ande--}}
                                <option data-tokens=="0" selected="true" disabled="disabled">Seleccione</option>

                                @foreach ($clientes as $cliente)
                                    <option value="{{$cliente->id}}"> {{$cliente->denominacion}}</option>
                                @endforeach
                            </select>
                            <label for="producto"
                                   class="col-md-1 col-form-label text-md-right offset-md-1">Producto</label>

                            <select name="producto" id="producto" class="productos custom-select col-md-2">
                                <option data-tokens=="0" selected="true" disabled="disabled">Seleccione</option>
                            </select>

                            <label for="cantidad"
                                   class="col-md-1 col-form-label text-md-right offset-md-1">Cantidad</label>

                            <input id="cantidad" type="number" class="form-control col-md-1 mr-5 cantidadjs"
                                   placeholder="KG" step="1000" name="cantidad" value="{{old('cantidad')}}" required>

                            <a class="btn btn-info" id="btnCalcular">Calcular</a>

                        </div>


                        <div class="form-group row d-flex justify-content-center border-top mt-5">
                            <label for="insumosTrazables" class="h3 mt-4 col-10">Insumos trazables
                                requeridos</label>
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
                            <label for="insumosNoTrazables" class="h3 text-md-left mt-5 col-7">Insumos no trazables
                                requeridos</label>
                            <p class="mt-5 col-3 border-left">Crédito restante cliente: <span
                                    id="creditoCliente"></span> kgs</p>

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

                        <div class="form-group row mt-5">
                            <label for="fechaentrega" class="col-md-2 col-form-label text-md-right">Fecha de
                                entrega</label>
                            <input id="fechaentrega" type="date" class="form-control col-md-2 fecha_entregajs"
                                   name="fechaentrega" value="{{old('fechaentrega')}}" required>
                            <p class="ml-3 mt-2 col-md-2">Disp. día:
                                <span class="col-1" id="capacidad_restante">-</span>kgs</p>

                            <label for="precioxkg" class="col-md-2 col-form-label text-md-right">Precio por tn.</label>
                            <input id="precioxkg" type="number" class="form-control col-md-1 preciojs" placeholder="$"
                                   value="{{old('precioxkg')}}" name="precioxkg" required>
                            <p class="col-2 mt-2">Precio min: $
                                <span class="">{{$precioFason->precio_por_tn}}</span> +-
                                <span>${{$precioFason->variacion_admitida * $precioFason->precio_por_tn}}</span>
                            </p>

                        </div>

                        <div class="form-inline row m-4">
                            <a href="{{route('pedidos.index')}}" class="btn btn-secondary col-sm-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary col-2 offset-8"
                                    id="submit">Registrar
                            </button>
                            <label class="justify-content-end col-12 text-danger mt-2 small" id="info-btn">
                                El botón se habilitará cuando la fórmula sea válida y no supere el crédito del cliente</label>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('js/altaPedidos2.js') }}"></script>

@endsection
