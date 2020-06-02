@extends('layouts.app')
@section('publics')
    <script src="{{ asset('js/RegistroIngresoInsumoFinal.js') }}"></script>
@endsection
@section('content')
<div class="container">
    <div class="bs-example">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" >Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('balanzas.menu')}}">Balanzas</a></li>
                <li class="breadcrumb-item"><a href="{{route('ingresos.index')}}">Gestión de ingresos</a></li>
                <li class="breadcrumb-item active">Finalizar ingreso</li>
            </ol>
        </nav>
    </div>

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
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center h2">{{ __('Registro de ingreso de insumo final') }}</div>

                <div class="card-body mt-3">
                    <form action="{{route('balanzas.ingresos.final.guardar')}}" method="POST">
                        @csrf
                        <div class="form-group row">

                            <label for="patente" class="col-md-2 col-form-label text-md-right">Patente</label>

                            <input id="patente" type="text"
                                   class="form-control col-md-2" name="patente"
                                   value="{{$viewbag['patente']}}" readonly
                            />

                            <label for="transportista" class="col-md-2 col-form-label text-md-right offset-md-1">Transportista</label>

                            <input name="transportista" id="transportista" class="form-control col-md-4"
                                   value="{{$viewbag['transportista']}}" readonly/>

{{--                            <button type="submit" class="btn btn-outline-success btn-block col-sm-2 offset-1">--}}
{{--                                Leer pesaje--}}
{{--                            </button>--}}
                        </div>


                        <br>

                        <div class="form-group row">
                            <label for="cliente" class="col-md-2 col-form-label text-md-right">Cliente</label>

                                <input name="cliente" id="cliente" type="text" value="{{$viewbag['cliente']}}"
                                       class="form-control col-md-4" readonly/>

                            <label for="nro" class="col-md-3 col-form-label text-md-right">NRO cbte</label>

                            <input id="nro" value="{{$viewbag['nroCbte']}}" type="text" class="form-control col-md-2" name="nro" readonly>

                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="insumo" class="col-md-2 col-form-label text-md-right">Insumo</label>

                                <input name="insumo" id="insumo" value="{{$viewbag['insumo']}}" class="form-control col-md-3" readonly>

                                <label for="proveedor" class="col-md-2 col-form-label text-md-right">Proveedor</label>

                            <input id="proveedor" type="text" value="{{$viewbag['proveedor']}}" class="form-control col-md-4" name="proveedor" readonly>

                        </div>
                        <br>

                        <div class="form-group row">
                            <label for="nrolote" class="col-md-2 col-form-label text-md-right">Nro Lote</label>

                                <input id="nrolote" value="{{$viewbag['nrolote']}}" type="text" class="form-control col-md-2" name="nrolote" readonly>

                        </div>
                        <br>


                        <div class="form-group row mt-4">
                            <label for="bruto" class="col-md-2 col-form-label text-md-right">Peso Bruto</label>
                            <input id="bruto" value="{{$viewbag['bruto']}}" type="text" class="bruto form-control col-md-2" placeholder="Bruto" name="bruto" readonly>
                            <span class="ml-2 mt-2">kg</span>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="tara" class="col-md-2 col-form-label text-md-right">Peso Tara</label>
                            <input id="tara" type="text" class="form-control col-md-2" placeholder="Tara" name="tara" readonly>
                            <span class="ml-2 mt-2">kg</span>

                            {{--<button type="submit" class="btn btn-outline-success btn-block col-md-2 offset-md-1">
                                Leer pesaje
                            </button>--}}
                            <label class="pesajeAleatorio btn btn-outline-success btn-block col-md-2 offset-md-1">Leer pesaje</label>
                        </div>
                        <br>
                        <div class="form-inline row m-3">
                            <button class="btn btn-secondary col-sm-3">Cancelar</button>
                            <button class="btn btn-primary col-sm-3 offset-md-6">Finalizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>--}}
{{--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>--}}
{{--  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>--}}
@endsection
