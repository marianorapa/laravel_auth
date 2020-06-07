@extends('layouts.app')


@section('publics')
    <script src="{{ asset('js/habilitarInput.js') }}"></script>
    <script src="{{ asset('js/registroInsumo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/notifCartel.js') }}"></script>
    <script src="{{ asset('js/errorCartel.js') }}"></script>

@endsection
@section('content')
    @inject('Cliente', 'App\Cliente')
    @inject('Insumo', 'App\Insumo')
    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('balanzas.menu')}}">Balanzas</a></li>
                    <li class="breadcrumb-item"><a href="{{route('ingresos.index')}}">Gestión de ingresos</a></li>
                    <li class="breadcrumb-item active">Nuevo ingreso</li>
                </ol>
            </nav>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">

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

                <div class="card">
                    <div class="card-header h2">{{ __('Registro de ingreso de insumo') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('balanzas.ingresos.inicial.guardar')}}">
                            @csrf

                            <div class="form-group row">
                                <label for="cliente" class="col-md-2 col-form-label text-md-right">Cliente</label>

                                <select name="cliente" id="cliente" class="custom-select col-md-6">
                                    <option data-tokens=="0">Seleccione</option>
                                    @foreach ($clientes as $cli )
                                        <option data-tokens="{{$cli->id}}"
                                                value="{{$cli->id}}"> {{$cli->empresa()->first()->denominacion}}</option>
                                    @endforeach
                                </select>


                            </div>
                            <div class="form-group row mt-1">
                                <label for="proveedor" class="col-md-2 col-form-label text-md-right">Proveedor</label>

                                <select name="proveedor" id="proveedor" class="selectProveedor custom-select col-md-6">
                                    @foreach($proveedores as $proveedor)
                                        <option
                                            value="{{$proveedor->id}}">{{$proveedor->empresa()->first()->denominacion}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="">

                                <div class="form-check form-check-inline ml-5 col-md-3">
                                    <input type="checkbox" class="checknrolote form-check-input ml-5"
                                           id="chec" name="isInsumoTrazable" data-toggle="collapse" data-target="#demo">
                                    <label for="estrazable" class="form-check-label">Insumo trazable</label>
                                </div>


                                <label for="insumo" class="col-md-2 col-form-label text-md-right">Insumo</label>

                                <select name="insumo" id="insumo" class="selectInsumo custom-select col-md-6">
                                    <option value="0">Seleccione</option>
                                </select>


                            </div>
                            <br>

                            <div id="demo" class="collapse">
                                <div class="form-group row">
                                    <label for="nrolote" class="col-lg-2 col-form-label text-md-right">Nro
                                        Lote</label>
                                    <input id="nrolote" type="text" class="form-control col-md-2 lotejs"
                                           name="nrolote" value="{{old("nrolote")}}" required>

                                </div>

                                <div class="form-group row mt-4">
                                    <label for="elaboracion"
                                           class="col-lg-2 col-form-label text-md-right">Elaboración</label>
                                    <input id="fechaelaboracion" type="date"
                                           class="fechaelaboracion form-control col-md-3 elaboracionjs"
                                           name="fechaelaboracion" value="{{old("fechaelaboracion")}}">
                                </div>
                                <div class="form-group row mt-4">
                                    <label for="vencimiento"
                                           class="col-lg-2 col-form-label text-md-right">Vencimiento</label>
                                    <input id="fechavencimiento" type="date"
                                           class="fechavencimiento form-control col-md-3 vencimientojs"
                                           name="fechavencimiento" value="{{old("fechavencimiento")}}">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="transportista"
                                       class="col-md-2 col-form-label text-md-right">Transportista</label>

                                <select name="transportista" id="transportista" class="custom-select col-md-4"
                                        data-show-subtext="true" data-live-search="true">
                                    @foreach($transportistas as $transportista)
                                        <option
                                            value="{{$transportista->id}}">{{$transportista->empresa()->first()->denominacion}}</option>
                                    @endforeach
                                </select>

                                <label for="patente"
                                       class="col-lg-2 col-form-label text-md-right">Patente</label>
                                <input id="patente" type="text" class="form-control col-md-2 patentejs"
                                       name="patente" placeholder="abc123 / ab123ab"
                                       pattern="[A-Za-z]{3}[0-9]{3}|[a-zA-Z]{2}[0-9]{3}[a-zA-Z]{2}"
                                       value="{{old('patente')}}" required>

                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="nro_cbte" class="col-lg-2 col-form-label text-md-right">NRO Remito/Carta
                                    de porte</label>
                                <input id="nro_cbte" type="text" class="form-control col-md-2 cartajs"
                                       name="nro_cbte" pattern="[0-9]{6,8}" value="{{old('nro_cbte')}}" required>
                                @error('nro_cbte')
                                <span class="invalid-feedback" role="alert">
                                <strong>Fecha invalida</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="form-group row mt-1">
                                <label for="pesaje" class="col-lg-2 col-form-label text-md-right">Peso
                                    vehiculo</label>
                                <input id="pesaje" type="text" class="pesajes form-control col-md-2 pesojs"
                                       placeholder="peso bruto" name="pesaje" readonly required>
                                <span class="ml-2 mt-2">kg</span>

                                <label class="pesajeAleatorio btn btn-success btn-block col-sm-2 offset-1">leer
                                    pesaje</label>
                            </div>
                            <br>
                            <div class="form-inline row">
                                <a class="btn btn-secondary col-sm-3"
                                   href="{{route('ingresos.index')}}">Cancelar</a>
                                <button type="submit" class="btn btn-primary col-sm-3 offset-md-6">Registrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{--Upd. 3-05 Marian. No se para que estaba esto pero duplicaba campos  --}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>--}}
    {{--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>--}}
    {{--  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>  --}}
@endsection
