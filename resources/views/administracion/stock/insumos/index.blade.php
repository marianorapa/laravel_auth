@extends('layouts.app')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/notifCartel.js') }}"></script>
    <script src="{{ asset('js/errorCartel.js') }}"></script>
@section('content')
    <section class="container">
        <section>
            <div class="bs-example">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('administracion.menu')}}">Administracion</a></li>
                        <li class="breadcrumb-item"><a href="{{route('administracion.stock')}}">Stock</a></li>
                        <li class="breadcrumb-item active">Gestión de Stock de Insumos</li>
                    </ol>
                </nav>
            </div>
{{--            <div class="row justify-content-center mt-4">--}}
{{--                <a class="btn btn-primary btn m-1 col-3" href="{{route('pedidos.create')}}">Nuevo Pedido</a>--}}
{{--            </div>--}}
            <div class="row justify-content-center mt-4 border-top border-bottom py-3">
                <form class="form-inline">
                    <input name="cliente" class="form-control mr-sm-2" type="search" placeholder="Cliente" aria-label="buscar por cliente">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
            </div>
        </section>

        <section>
            <table class="table mt-5">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{$errors->first()}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

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
                    <thead>
                        <tr>
                            <th scope="col">Cliente</th>
                            <th scope="col">Insumo</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Lote</th>
                            <th scope="col">Proveedor</th>
                            <th scope="col">Stock (kgs)</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($insumos as $insumo)
                        <tr>
                            <td scope="row">{{$insumo->cliente}}</td>
                            <td>{{$insumo->descripcion}}</td>
                            @if (isset($insumo->nro_lote))
                                <td>Trazable</td>
                                <td>{{$insumo->nro_lote}}</td>
                                <td>{{$insumo->proveedor}}</td>
                            @else
                                <td>No Trazable</td>
                                <td>-</td>
                                <td>-</td>
                            @endif
                            <td>{{$insumo->stock}}</td>
                        </tr>
                   @endforeach
                    </tbody>
            </table>

            <div class="row justify-content-center mt-5">
{{--                {{$ops->links()}}--}}
            </div>

        </section>


    </section>
@endsection
