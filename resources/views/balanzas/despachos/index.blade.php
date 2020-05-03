@extends('layouts.app')

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
                <a class="btn btn-primary btn m-1 col-3" href="{{route('permisos.create')}}">Nuevo despacho</a>
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

                @if (session('mensaje'))
                    <div class="alert alert-success">
                        {{session('mensaje')}}
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
{{--                    @foreach ($ingresos as $ingreso)--}}
{{--                        <tr>--}}
{{--                            <th scope="row">{{$ingreso->id}}</th>--}}
{{--                            <td>{{$ingreso->cliente->nombre}}</td>--}}
{{--                            <td>{{$ingreso->fecha}}</td>--}}
{{--                            <!--<td>{{//$permiso->trashed() ? "No": "Si"}}</td> -->--}}
{{--                            <td>{{$ingreso->insumo->nombre}}</td>--}}
{{--                            <td>--}}
{{--                                <a href="{{route('ingresos.edit', $ingreso)}}" class="btn btn-warning btn-sm">Editar</a>--}}
{{--                                @if (!$permiso->trashed())--}}
{{--                                    <form action="{{route('ingresos.destroy', $ingreso)}}" method="POST" class="d-inline">--}}
{{--                                        @method('DELETE')--}}
{{--                                        @csrf--}}
{{--                                        <button class="btn btn-danger btn-sm">Eliminar</button>--}}
{{--                                    </form>--}}
{{--                                @else--}}
{{--                                    <a class="btn btn-success btn-sm" href="{{route('permisos.activate',$permiso->id)}}">Activar</a>--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
                        <tr>
                            <th scope="row">1</th>
                            <td>Chinos</td>
                            <td>19/04/20</td>
                            <td>Alimento para cerdos 12AS</td>
                            <td>15000</td>
                            <td>ABC123</td>
                            <td>
                                <a href="" class="btn btn-warning btn-sm">Editar</a>
                                <a class="btn btn-success btn-sm" href="">Finalizar</a>
                            </td>
                        </tr>
                    </tbody>
            </table>
        </section>


    </section>
@endsection
