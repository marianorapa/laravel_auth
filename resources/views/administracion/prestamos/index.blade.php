@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{ asset('js/notifCartel.js') }}"></script>
<script src="{{ asset('js/errorCartel.js') }}"></script>
<script src="{{ asset('js/validarFiltros.js') }}"></script>
@section('content')
    <section class="container">
        <section>
            <div class="bs-example">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('administracion.menu')}}">Administración</a></li>
                        <li class="breadcrumb-item active">Gestión de Préstamos</li>
                    </ol>
                </nav>
            </div>
            {{--            <div class="row justify-content-center mt-4">--}}
            {{--                <a class="btn btn-primary btn m-1 col-3" href="{{route('pedidos.create')}}">Nuevo Pedido</a>--}}
            {{--            </div>--}}
            <div class="row justify-content-center mt-4 border-top border-bottom py-3">
                <form class="form-inline">
                    <input name="cliente" class="form-control mr-sm-2 clientejs" type="search" placeholder="Cliente"
                           aria-label="buscar por cliente">
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
                    <th scope="col">#</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Insumo</th>
                    <th scope="col">Cant. prestada</th>
                    <th scope="col">Cant. devuelta</th>
                    <th scope="col">Estado</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($prestamos as $prestamo)
                    <tr>
                        <th scope="row">{{$prestamo->id}}</th>
                        <td>{{$prestamo->fecha}}</td>
                        <td>{{$prestamo->cliente}}</td>
                        <td>{{$prestamo->insumo}}</td>
                        <td>{{$prestamo->cantidad}}</td>
                        <td>{{$prestamo->cancelado}}</td>
                        @if ($prestamo->anulado)
                            <td class="text-danger">Anulado*</td>
                        @else
                            @if ($prestamo->cancelado == $prestamo->cantidad)
                                <td class="text-success">Saldado</td>
                            @else
                                <td class="text-info">Pendiente</td>
                            @endif
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>

            <p class="mt-5 text-dark">*La cantidad devuelta de un préstamo anulado, ya se ha reintegrado al stock del
                cliente.</p>

            <div class="row justify-content-center mt-5">
                {{--                {{$insumos->links()}}--}}
            </div>

        </section>
        <a class="btn btn-secondary btn-sm"
           href="{{route('administracion.menu')}}">Volver</a>{{--Cambiar en un futuro--}}

    </section>
@endsection
