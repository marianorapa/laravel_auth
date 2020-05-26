@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" >Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('balanzas.menu')}}" >Balanzas</a></li>
                    <li class="breadcrumb-item"><a href="{{route('despachos.index')}}" >Gestion de despacho</a></li>
                    <li class="breadcrumb-item active">Finalizar despacho</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center align-self-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header text-center h2">
                    {{__('Pesaje final de despacho')}}
                </div>

                <div class="card-body">
                    <form action="{{route('despachos.finalize.post')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="patente" class="col-md-1 col-form-label text-md-right">Patente</label>
                            <input id="patente" type="text" class="form-control col-md-2" placeholder="patente" name="patente" >
{{--                            <button type="submit" class="btn btn-outline-success btn-block col-sm-2 offset-1">--}}
{{--                                Retomar despacho--}}
{{--                            </button>--}}
                        </div>

                        <div class="form-group row mt-5">
                            <label for="cliente" class="col-md-1 col-form-label text-md-right">Cliente</label>
                            <input id="cliente" type="text" class="form-control col-md-2" placeholder="" name="cliente" >


                        </div>

                        <div class="form-group row mt-2">
                            <label for="producto" class="col-md-1 col-form-label text-md-right">Producto</label>
                            <input id="producto" type="text" class="form-control col-md-2 " placeholder="" name="producto" >

                            <label for="nro orden" class="col-lg-2 col-form-label text-md-right offset-md-0">nro orden</label>
                            <input id="nroorden" type="text" class="form-control col-md-2 " placeholder="" name="nroorden" >



                        </div>

                        <div class="form-group row mt-5">
                            <label for="transportista" class="col-md-1 col-form-label text-md-left">Transportista</label>
                            <input id="transportista" type="text" class="form-control col-md-2" placeholder="" name="transportista" >
                        </div>

                        <div class="form-group row mt-3">
                            <label for="pesovehiculo" class="col-md-1 col-form-label text-md-left">Peso vehiculo</label>
                            <input id="peso" type="text" class="form-control col-md-2" placeholder="" name="peso" >

                            <label for="pesovcargado" class="col-lg-2 col-form-label text-md-right offset-md-0">peso vehiculo cargado</label>
                            <input id="pesocargado" type="text" class="form-control col-md-2" placeholder="" name="pesocargado" >
                            <button type="submit" class="btn btn-outline-success btn-block col-sm-2 offset-1">
                               leer pesaje
                            </button>
                        </div>

                        <div class="form-inline row mt-5">
                            <button class="btn btn-secondary col-sm-2">Cancelar</button>
                            <button class="btn btn-primary col-sm-2 offset-md-8">Finalizar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
