@extends('layouts.app')

@section('content')
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
                <div class="card-header text-center h2">{{ __('Registro de ingreso de insumo final') }}</div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf
                        <div class="form-group row">
                            <label for="patente" class="col-md-2 col-form-label text-md-right">Patente</label>

                            <input id="patente" type="text" class="form-control col-md-2" name="patente" placeholder="Nro patente" required>

                            <button type="submit" class="btn btn-outline-success btn-block col-sm-2 offset-1">
                                Leer pesaje
                            </button>
                        </div>
                        <br>

                        <div class="form-group row">
                            <label for="cliente" class="col-md-2 col-form-label text-md-right">Cliente</label>

                                <select name="cliente" id="cliente" class="selectpicker show-menu-arrow" data-show-subtext="true" data-live-search="true" >

                                </select>

                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="insumo" class="col-md-2 col-form-label text-md-right">Insumo</label>

                                <select name="insumo" id="insumo" class="selectpicker" data-show-subtext="true" data-live-search="true">

                                </select>

                                <label for="cliente" class="col-md-2 col-form-label text-md-right offset-md-2">Proveedor</label>

                                <select name="insumo" id="insumo" class="selectpicker" data-show-subtext="true" data-live-search="true">

                                </select>



                        </div>
                        <br>

                        <div class="form-group row">
                            <label for="nrolote" class="col-md-2 col-form-label text-md-right">Nro Lote</label>

                                <input id="nrolote" type="text" class="form-control col-md-2" name="nrolote" required>

                        </div>
                        <br>
                        <br>
                        <div class="form-group row">
                            <label for="transportista" class="col-md-2 col-form-label text-md-right">Transportista</label>

                            <select name="transportista" id="transportista" class="selectpicker" data-show-subtext="true" data-live-search="true">

                            </select>

                            <label for="nro" class="col-md-2 col-form-label text-md-right offset-md-2">NRO Remito/Carta de porte</label>

                            <input id="nro" type="text" class="form-control col-md-2" name="nro" required>

                        </div>
                        <br>

                        <div class="form-group row">
                            <label for="pesaje" class="col-md-2 col-form-label text-md-right">Peso vehiculo</label>
                            <input id="pesaje" type="text" class="form-control col-md-2" placeholder="peso bruto" name="pesaje" required>

                        </div>
                        <div class="form-group row">
                            <label for="pesaje" class="col-md-2 col-form-label text-md-right">Peso vehiculo</label>
                            <input id="pesaje" type="text" class="form-control col-md-2" placeholder="peso bruto" name="pesaje" required>


                            <button type="submit" class="btn btn-outline-success btn-block col-md-2 offset-md-1">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
@endsection
