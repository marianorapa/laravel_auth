@extends('layouts.app')
@section('publics')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/notifCartel.js') }}"></script>
    <script src="{{ asset('js/errorCartel.js') }}"></script>
@endsection

@section('content')
    <section class="container">

        <section>
            <div class="bs-example">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" >Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('balanzas.menu')}}" >Balanzas</a></li>
                        <li class="breadcrumb-item active">Gestion de Despachos</li>
                    </ol>
                </nav>
            </div>

            <div class="row justify-content-center mt-4">
                <a class="btn btn-primary btn m-1 col-3" href="{{route('despachos.create')}}">Nuevo despacho</a>
            </div>
            <div class="row justify-content-center mt-4 border-top border-bottom py-3">
                <form class="form-inline">
                    <input name='patente' class="form-control mr-sm-2" type="search" placeholder="Patente" aria-label="buscar por patente">
                    <input name='cliente' class="form-control mr-sm-2" type="search" placeholder="Cliente" aria-label="buscar por cliente">
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

                @if (session('message'))
                <div class="" role="alert">
                    <p class="alertajs" style="display:none">{{ session('message') }}</p>
                </div>
                @endif


                @if (session('error'))
                <div class="">
                    <p class="errorjs" style="display:none">{{ session('error') }}</p>
                </div>
                @endif

                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Patente</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($despachos as $despacho)
                        <tr>
                            <th scope="row">{{$despacho->id}}</th>
                            <td>{{$despacho->denominacion}}</td>
                            <td>{{$despacho->fecha}}</td>
                            <td>{{$despacho->descripcion}}</td>
                            <td>{{$despacho->cantidad}}</td>
                            <td>{{$despacho->patente}}</td>
                            @if ($despacho->deleted_at)
                                <td>
                                    <span class="border border-danger btn-sm btn-outline-danger disabled">Anulado</span>
                                </td>
                            @else
                                @if ($despacho->bruto)
                                    <td>
                                        <span class="border border-success btn-sm btn-outline-success disabled">Finalizado</span>
                                    </td>
                                @else
                                    <td>{{--                                    <a href="" class="btn btn-warning btn-sm">Editar</a>--}}
                                        <a class="btn btn-success btn-sm"
                                           href="{{route('despachos.finalize.view', $despacho->id)}}">
                                            Finalizar
                                        </a>
                                        <a class="btn btn-danger btn-sm"
                                           href="{{route('despachos.destroy', $despacho->id)}}">X</a>
                                    </td>
                                @endif
                            @endif
                        </tr>
                    @endforeach

                    </tbody>
            </table>
        </section>


    </section>
@endsection
