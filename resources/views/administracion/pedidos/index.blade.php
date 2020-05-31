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
                        <li class="breadcrumb-item active">Gestión de Pedidos</li>
                    </ol>
                </nav>
            </div>
            <div class="row justify-content-center mt-4">
                <a class="btn btn-primary btn m-1 col-3" href="{{route('pedidos.create')}}">Nuevo Pedido</a>
            </div>
            <div class="row justify-content-center mt-4 border-top border-bottom py-3">
                <form class="form-inline">
                <a type="submit" class="btn btn-info btn-sm m-1 btn_pdf" href="{{ route('pedido.pdf') }}">Descargar PDF</a><!--todavia no anda, primera prueba-->
                    <input name="patente" class="form-control mr-sm-2" type="search" placeholder="Producto" aria-label="buscar por producto">
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
                            <th scope="col">#</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Fecha Entrega</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($ops as $op)
                        <tr>
                            <th scope="row">{{$op->op_id}}</th>
                            <td>{{$op->empresa}}</td>
                            <td>{{$op->fecha_fabricacion}}</td>
                            <td id="producto">{{$op->producto}}</td>
                            <td id="cantidad">{{$op->cantidad}}</td>
                            @if ($op->descripcion == "Pendiente")
                                <td>
                                    <a class="btn btn-success btn-sm" href="{{route('pedidos.finalize', $op->op_id)}}">Finalizar</a>
                                    <a class="btn btn-danger btn-sm" href="{{route('pedidos.cancel', $op->op_id)}}">X</a>
                                </td>
                            @else
                                @if ($op->descripcion == "Finalizada")
                                    <td>
                                        <span class="btn btn-sm btn-outline-success disabled">Finalizado</span>
                                    </td>
                                @else
                                    <td>
                                        <span class="btn btn-sm btn-outline-danger disabled">Anulado</span>
                                    </td>
                                @endif
                            @endif
                        </tr>
                   @endforeach
                    </tbody>
            </table>

            <div class="row justify-content-center mt-5">
{{--                {{$ops->links()}}--}}
            </div>

        </section>

        <a class="btn btn-secondary btn-sm" href="{{route('administracion.menu')}}">Volver</a>
    </section>
@endsection
