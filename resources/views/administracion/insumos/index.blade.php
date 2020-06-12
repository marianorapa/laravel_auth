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
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('administracion.menu')}}">Administración</a></li>
                        <li class="breadcrumb-item active">Gestión de Insumos</li>
                    </ol>
                </nav>
            </div>

            <div class="col-md-10">
                @if (session('error'))
                    <div class="">
                        <p class="errorjs" style="display:none">{{ session('error') }}</p>
                    </div>
                @endif
                @if (session('message'))
                    <div class="" role="alert">
                        <p class="alertajs" style="display:none">{{ session('mensaje') }}</p>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-12 text-right">
                    <a class="btn btn-success btn" href="{{route('insumos.create.normal')}}">+ Insumo Genérico</a>
                    <a class="btn btn-primary btn ml-3" href="{{route('insumos.create.especifico')}}">+ Insumo Específico</a>
                </div>
            </div>
            <div class="row justify-content-center mt-4 border-top border-bottom py-3">
                <form class="form-inline">
                    <input name="descripcion" class="form-control mr-sm-2 productojs" type="search" placeholder="Descripcion"
                           aria-label="buscar por Alimento">
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

                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Proveedor</th>
                    {{--                        <th scope="col">Acciones</th>--}}
                </tr>
                </thead>

                <tbody>
                @foreach($insumos as $insumo)
                    <tr>
                        <th scope="row">{{$insumo->id}}</th>
                        <td>{{$insumo->descripcion}}</td>
                        @isset ($insumo->insumoNoTrazable)
                            <td>No trazable</td>
                        @else
                            <td>Trazable</td>
                        @endisset
                        <td>-</td>
                    </tr>
                @endforeach
                @foreach($insumosEspecificos as $insumoEspecifico)
                    <tr>
                        <th scope="row">{{$insumoEspecifico->gtin}}</th>
                        <td>{{$insumoEspecifico->descripcion}}</td>
                        <td>Específico</td>
                        <td>{{$insumoEspecifico->proveedor->empresa->denominacion}}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            <div class="row justify-content-center">
                {{$insumos->links()}}
            </div>
        </section>
        <a class="btn btn-secondary btn-sm" href="{{route('administracion.menu')}}">Volver</a>
    </section>

@endsection
