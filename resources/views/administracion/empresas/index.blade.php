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
                        <li class="breadcrumb-item active">Gestión de Empresas</li>
                    </ol>
                </nav>
            </div>
            <div class="row justify-content-center mt-4">
                <a class="btn btn-primary btn m-1 col-3" href="{{route('empresas.create')}}">Nueva empresa</a>
            </div>
            <div class="row justify-content-center mt-4 border-top border-bottom py-3">
                <form class="form-inline">
                    <input name="patente" class="form-control mr-sm-2 productojs" type="search" placeholder="Producto" aria-label="buscar por producto">
                    <input name="cliente" class="form-control mr-sm-2 clientejs" type="search" placeholder="Cliente" aria-label="buscar por cliente">
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
                            <th scope="col">Denominación</th>
                            <th scope="col">Fecha inicio actividades</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">GLN</th>
                            {{--
                            <th scope="col">Acciones</th>
                            --}}
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($empresas as $empresa)
                        <tr>
                            <th scope="row">{{$empresa->id}}</th>
                            <td scope="row">{{$empresa->denominacion}}</td>
                            <td scope="row">{{$empresa->fecha_inicio_actividades}}</td>
                            <td scope="row">{{$empresa->tipo}}</td>
                            <td scope="row">{{$empresa->gln == null ? '-' : $empresa->gln}}</td>
                            {{--
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Editar</a>
                                <a class="btn btn-danger btn-sm" href="">X</a>
                            </td>
                            --}}
{{--                            @if ($op->descripcion == "Pendiente")--}}
{{--                                <td>--}}
{{--                                    <a href="#" class="btn btn-warning btn-sm">Editar</a>--}}{{--es update? lo dejo asi cualquier cosa--}}
{{--                                    <a class="btn btn-success btn-sm" href="{{route('pedidos.finalize', $op->op_id)}}">Finalizar</a>--}}
{{--                                </td>--}}
{{--                            @else--}}
{{--                                <td>--}}
{{--                                    <span class="btn btn-sm btn-outline-danger disabled">Finalizado</span>--}}
{{--                                </td>--}}
{{--                            @endif--}}
                        </tr>
                   @endforeach
                    </tbody>
            </table>

            <div class="row justify-content-center mt-5">
                {{$empresas->links()}}
            </div>

        </section>


    </section>
@endsection
