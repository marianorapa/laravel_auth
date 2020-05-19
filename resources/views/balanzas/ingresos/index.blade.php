@extends('layouts.app')

@section('content')
    <section class="container">

        <section>
            <div class="bs-example">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" >Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('balanzas.menu')}}" >Balanzas</a></li>
                        <li class="breadcrumb-item active">Gestión de Ingresos</li>
                    </ol>
                </nav>
            </div>

            <div class="row justify-content-center mt-4">
                <a class="btn btn-primary btn m-1 col-3" href="{{route('balanzas.ingresos.inicial')}}">Nuevo ingreso</a>
            </div>
            <div class="row justify-content-center mt-4 border-top border-bottom py-3">
                <form class="form-inline">
                    <input name="patente" class="form-control mr-sm-2" type="search" placeholder="Patente" aria-label="buscar por patente">
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

                @if (session('message'))
                    <div class="alert alert-success">
                        {{session('message')}}
                    </div>
                @endif

                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Insumo</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Patente</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($ticketsEntrada as $ticketEntrada)
                        <tr>
                            <th scope="row">{{$ticketEntrada->id}}</th>
                            <td>{{$ticketEntrada->ticket()->first()
                                                ->cliente()->first()
                                                ->empresa()->first()->denominacion}}
                            </td>
                            <td>{{$ticketEntrada->ticket()->first()->created_at}}</td>

                            @if ($ticketEntrada->ticketEntradaInsumoNoTrazable()->exists())
                                <td>{{$ticketEntrada->ticketEntradaInsumoNoTrazable()->first()
                                                    ->insumoNoTrazable()->first()
                                                    ->insumo()->first()->descripcion}}
                                </td>
                            @else
                                @if ($ticketEntrada->ticketEntradaInsumoTrazable()->exists())
                                <td>{{$ticketEntrada->ticketEntradaInsumoTrazable()->first()
                                                    ->insumoTrazable()->first()
                                                    ->insumo()->first()->descripcion}}
                                </td>
                                @else
                                    <td>-</td>
                                @endif
                            @endif

                            <td>{{$ticketEntrada->ticket()->first()->bruto()->first()->peso}}</td>
                            <td>{{$ticketEntrada->ticket()->first()->patente}}</td>
                            <td>
                                <a href="" class="btn btn-warning btn-sm">Editar</a>
                                <a class="btn btn-success btn-sm" href="{{route('balanzas.ingresos.final', $ticketEntrada->id)}}">Finalizar</a>
                            </td>
                    @endforeach
                    </tbody>
            </table>
        </section>


    </section>
@endsection
