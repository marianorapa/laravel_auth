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
                    <input name="patente" class="form-control mr-sm-2 patentejs" type="search" placeholder="Patente" aria-label="buscar por patente" >
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
                        <th scope="col">Insumo</th>
                        <th scope="col">Bruto</th>
                        <th scope="col">Tara</th>
                        <th scope="col">Patente</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($ticketsEntrada as $ticketEntrada)

                        @if ($ticketEntrada->ticket()->exists())

{{--                        @if (is_object($ticketEntrada))--}}
{{--                            <tr>--}}
{{--                                <th scope="row">{{$ticketEntrada->id}}</th>--}}
{{--                                <td scope="row">{{$ticketEntrada->denominacion}}</td>--}}
{{--                                <td scope="row">{{$ticketEntrada->created_at}}</td>--}}
{{--                                <td scope="row">{{$ticketEntrada->descripcion}}</td>--}}
{{--                                <td scope="row">{{$ticketEntrada->bruto}}</td>--}}
{{--                                <td scope="row">{{$ticketEntrada->tara}}</td>--}}
{{--                                <td scope="row">{{$ticketEntrada->patente}}</td>--}}
{{--                            </tr>--}}
{{--                        @endif--}}


                            <tr>
                                <th scope="row">{{$ticketEntrada->id}}</th>
                                <td>{{$ticketEntrada->ticket()->first()
                                                    ->cliente()->first()
                                                    ->empresa()->first()->denominacion}}
                                </td>
                                <td>{{date_format($ticketEntrada->ticket()->first()->created_at, 'd-m-Y H:i')}}</td>

                                @if ($ticketEntrada->ticketEntradaInsumoNoTrazable()->exists())
                                    <td>{{$ticketEntrada->ticketEntradaInsumoNoTrazable()->first()
                                                        ->insumoNoTrazable()->first()
                                                        ->insumo()->first()->descripcion}}
                                    </td>
                                @else
                                    @if ($ticketEntrada->ticketEntradaInsumoTrazable()->exists())
                                    <td>{{$ticketEntrada->ticketEntradaInsumoTrazable()->first()
                                                        ->loteInsumoEspecifico()->first()
                                                        ->insumoEspecifico()->first()
                                                        ->insumoTrazable()->first()
                                                        ->insumo()->first()->descripcion}}
                                    </td>
                                    @else
                                        <td>-</td>
                                    @endif
                                @endif

                                <td>{{$ticketEntrada->ticket()->first()->bruto()->first()->peso}}</td>
                                @if ($ticketEntrada->ticket()->first()->tara()->exists())
                                    <td>{{$ticketEntrada->ticket()->first()->tara()->first()->peso}}</td>
                                @else
                                    <td>(pendiente)</td>
                                @endif
                                <td>{{$ticketEntrada->ticket()->first()->patente}}</td>
                                <td>

                                    @if (!$ticketEntrada->ticket()->first()->tara()->exists())
    {{--<a href="" class="btn btn-warning btn-sm">Editar</a>--}}

                                    <form method="get" id="destroy-appointment-{{ $ticketEntrada }}" action="{{route('balanzas.ingresos.destroy', $ticketEntrada->id)}}" onSubmit="return confirm('Desea eliminar?');">
                                    <a class="btn btn-success btn-sm mr-3" href="{{route('balanzas.ingresos.final', $ticketEntrada->id)}}">Finalizar</a>
                                    <button class ="btn btn-danger btn-sm font-weight-bolder" type="submit" form="destroy-appointment-{{ $ticketEntrada }}">X</button>
                                    </form>

                                    @else
                                       <!-- <span class="border border-success btn-sm btn-outline-success disabled">Finalizado</span>  -->

                                        <a href="{{ route('ticketEntrada.pdf', $ticketEntrada->id )}}" target="_blank"
                                           class="btn btn-outline-success btn-sm btn_pdf">Imprimir</a>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
            </table>
            <div class="row justify-content-center">
                {{$ticketsEntrada->links()}}
            </div>
        </section>


    </section>
@endsection
