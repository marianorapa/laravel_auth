@extends('layouts.app')


@section('publics')
<script src="{{ asset('js/habilitarinput.js') }}"></script>
<script src="{{ asset('js/registroInsumo.js') }}"></script>

@endsection
@section('content')
@inject('Cliente', 'App\Cliente')
@inject('Insumo', 'App\Insumo')
<div class="container">
    <div class="bs-example">
        <nav>
            <ol class="breadcrumb">

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
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
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

            <div class="card">
                <div class="card-header h2">{{ __('Registro de ingreso de insumo') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('balanzas.ingresos.inicial.guardar')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="cliente" class="col-md-2 col-form-label text-md-right">Cliente</label>

                                <select name="cliente" id="cliente"  class="custom-select col-md-2">
                                    <option data-tokens=="0">Seleccione</option>

{{--                                    @foreach ($Cliente->getClientesAsArray() as $index => $cli )--}}

{{--                                        <option data-tokens="{{$cli}}"> {{$cli}}</option>--}}
{{--                                    @endforeach--}}
{{--                                    Edit. Marian. El controller me pasa los clientes, yo en la vista no "conozco" el modelo--}}
                                    @foreach ($clientes as $cli )
                                        <option data-tokens="{{$cli->id}}" value="{{$cli->id}}"> {{$cli->empresa()->first()->denominacion}}</option>
                                    @endforeach
{{--                                    <option data-tokens="julia"> julia</option>--}}
{{--                                    <option data-tokens="adasd"> asdasdsa</option>--}}
{{--                                    <option data-tokens="qweqeq"> qweqweqe</option>--}}
{{--                                    <option data-tokens="pedro"> pedro</option>--}}
{{--                                    <option data-tokens="fernando">fernando</option>--}}
                                </select>
                            {{--<div class="autocomplete"  >
                                <input type="miinput" type="text" name="misnombres" placeholder="nombre">
                            </div>--}}


                        </div>
                        <br>
                        <div class="form-group row">
                                <label for="insumo" class="col-md-2 col-form-label text-md-right">Insumo</label>

                                <select name="insumo" id="insumo"  class="selectInsumo custom-select col-md-2">
                                    <option value="0">Seleccione</option>

{{--                                    @foreach ($Insumo->getinsumo() as $index => $ins)--}}
{{--                                        <option data-tokens="{{$index}}"> {{$ins}}</option> --}}{{--puede que esto no busque bien por que tiene el index en data tokens--}}
{{--                                    @endforeach--}}
                                    {{--@foreach ($insumos as $insumo )
                                        <option data-tokens="{{$insumo->id}}" value="{{$insumo->id}}"> {{$insumo->descripcion}}</option>
                                    @endforeach--}}
                                </select>

                                <label for="proveedor" class="col-lg-2 col-form-label text-md-right offset-md-2">Proveedor</label>

                                <select name="proveedor" id="proveedor" class="selectProveedor custom-select col-md-2" >
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{$proveedor->id}}">{{$proveedor->empresa()->first()->denominacion}}</option>
                                    @endforeach
                                </select>



                        </div>
                        <br>

                        <div class="form-group row">
                            <label for="nrolote" class="col-lg-2 col-form-label text-md-right">Nro Lote</label>
                                <input id="nrolote" type="text" class="form-control col-md-2 lotejs" name="nrolote" required>
                                <label for="estrazable" class="col-lg-2 col-form-label text-md-right">es trazable?</label>
                                <input type="checkbox" class="checknrolote mt-md-2" id="chec" name="isInsumoTrazable">
                        </div>

                        <div class="form-group row mt-4">
                            <label for="elaboracion" class="col-lg-2 col-form-label text-md-right">Elaboracion</label>
                            <input id="fechaelaboracion" type="date" class="fechaelaboracion form-control col-md-2 elaboracionjs" name="fechaelaboracion">
                        </div>
                        <div class="form-group row mt-4">
                            <label for="vencimiento" class="col-lg-2 col-form-label text-md-right">Vencimiento</label>
                            <input id="fechavencimiento" type="date" class="fechavencimiento form-control col-md-2 vencimientojs" name="fechavencimiento">
                        </div>

                        <br>
                        <div class="form-group row">
                            <label for="transportista" class="col-md-2 col-form-label text-md-right">Transportista</label>

                            <select name="transportista" id="transportista" class="custom-select col-md-2" data-show-subtext="true" data-live-search="true">
                                @foreach($transportistas as $transportista)
                                    <option value="{{$transportista->id}}">{{$transportista->empresa()->first()->denominacion}}</option>
                                @endforeach
                            </select>

                            <label for="patente" class="col-lg-2 col-form-label text-md-right offset-md-2">Patente</label>
                            <input id="patente" type="text" class="form-control col-md-2 patentejs" name="patente" placeholder="abc123 / ab123ab" required>

                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="nro_cbte" class="col-lg-2 col-form-label text-md-right">NRO Remito/Carta de porte</label>
                                <input id="nro_cbte" type="text" class="form-control col-md-2 cartajs" name="nro_cbte" required>

                        </div>
                        <br>

                        <div class="form-group row">
                            <label for="pesaje" class="col-lg-2 col-form-label text-md-right">Peso vehiculo</label>
                                <input id="pesaje" type="text" class="pesajes form-control col-md-2 pesojs" placeholder="peso bruto" name="pesaje" readonly required>
                                <span class="ml-2 mt-2">kg</span>

                            <label class="pesajeAleatorio btn btn-success btn-block col-sm-2 offset-1" >leer pesaje</label>
                        </div>
                        <br>
                        <div class="form-inline row">
                            <a class="btn btn-secondary col-sm-3" href="{{route('ingresos.index')}}">Cancelar</a>
                            <button type="submit"  class="btn btn-primary col-sm-3 offset-md-6">Registrar</button>
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
