@extends('layouts.app')


@section('publics')
<script src="{{ asset('js/habilitarinput.js') }}"></script>

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
            <div class="card">
                <div class="card-header">{{ __('Registro de ingreso de insumo') }}</div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="form-group row">
                            <label for="cliente" class="col-md-2 col-form-label text-md-right">Cliente</label>

                                <select name="cliente" id="cliente"  class="custom-select col-md-2">
                                    <option data-tokens=="0">Seleccione</option>

                                    @foreach ($Cliente->getcliente() as $index => $cli )

                                        <option data-tokens="{{$cli}}"> {{$cli}}</option>
                                    @endforeach
                                    <option data-tokens="julia"> julia</option>
                                    <option data-tokens="adasd"> asdasdsa</option>
                                    <option data-tokens="qweqeq"> qweqweqe</option>
                                    <option data-tokens="pedro"> pedro</option>
                                    <option data-tokens="fernando">fernando</option>
                                </select>


                        </div>
                        <br>
                        <div class="form-group row">
                                <label for="insumo" class="col-md-2 col-form-label text-md-right">Insumo</label>

                                <select name="insumo" id="insumo"  class="custom-select col-md-2">
                                    <option data-tokens=="0">Seleccione</option>

                                    @foreach ($Insumo->getinsumo() as $index => $ins)

                                        <option data-tokens="{{$index}}"> {{$ins}}</option> {{--puede que esto no busque bien por que tiene el index en data tokens--}}
                                    @endforeach
                                </select>

                                <label for="proveedor" class="col-lg-2 col-form-label text-md-right offset-md-2">Proveedor</label>

                                <select name="proveedor" id="proveedor" class="selectpicker" data-show-subtext="true" data-live-search="true">

                                </select>



                        </div>
                        <br>

                        <div class="form-group row">
                            <label for="nrolote" class="col-lg-2 col-form-label text-md-right">Nro Lote</label>


                                <input id="nrolote" type="text" class="form-control col-md-2" name="nrolote"   required>
                                <input type="checkbox" class="checknrolote offset-md-1" id="chec" name="checone" >

                        </div>

                        <br>
                        <br>
                        <div class="form-group row">
                            <label for="transportista" class="col-md-2 col-form-label text-md-right">Transportista</label>

                            <select name="transportista" id="transportista" class="selectpicker" data-show-subtext="true" data-live-search="true">

                            </select>

                            <label for="patente" class="col-lg-2 col-form-label text-md-right offset-md-2">Patente</label>

                            <input id="patente" type="text" class="form-control col-md-2" name="patente" required>

                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="nro" class="col-lg-2 col-form-label text-md-right">NRO Remito/Carta de porte</label>


                                <input id="nro" type="text" class="form-control col-md-2" name="nro" required>

                        </div>
                        <br>

                        <div class="form-group row">
                            <label for="pesaje" class="col-lg-2 col-form-label text-md-right">Peso vehiculo</label>


                                <input id="pesaje" type="text" class="form-control col-md-2" placeholder="peso bruto" name="pesaje" required>

                            <button type="submit" class="btn btn-outline-success btn-block col-sm-2 offset-1">
                                Leer pesaje
                            </button>
                        </div>
                        <br>
                        <div class="form-inline row">
                            <button class="btn btn-secondary col-sm-3">Cancelar</button>
                            <button class="btn btn-primary col-sm-3 offset-md-6">Registrar</button>
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
