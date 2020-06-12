@extends('layouts.app')
@section('publics')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/sweetAlert2.js') }}"></script>
    <script src="{{ asset('js/notifCartel.js') }}"></script>
    <script src="{{ asset('js/errorCartel.js') }}"></script>
@endsection


@section('content')
    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('administracion.menu')}}">Administración</a></li>
                    <li class="breadcrumb-item"><a href="{{route('insumos.index')}}">Gestión de Insumos</a></li>

                    <li class="breadcrumb-item active">Nuevo Insumo Específico</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if (session('error'))
                <div class="" role="alert">
                    <p class="errorjs" style="display:none">{{ session('error') }}</p>
                </div>
            @endif

            @if (session('message'))
                <div class="" role="alert">
                    <p class="alertajs" style="display:none">{{ session('message') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="" role="alert">
                    <p class="errorjs" style="display:none">Todos los datos son obligatorios</p>
                </div>
            @endif

            <div class="card">
                <div class="card-header text-center h3">{{ __('Registro de Insumo') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('insumos.store.especifico')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="gtin"
                                   class="col-md-3 col-form-label text-md-right">{{ __('GTIN') }}</label>

                            <div class="col-md-6">
                                <input id="gtin" type="text" class="form-control" name="gtin"
                                       value="{{old('gtin')}}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="descripcion"
                                   class="col-md-3 col-form-label text-md-right">{{ __('Descripción') }}</label>

                            <div class="col-md-6">
                                <input id="descripcion" type="text" class="form-control" name="descripcion"
                                       value="{{old('descripcion')}}" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-form-label col-md-3 text-right" for="proveedor">Proveedor</label>
                            <div class="col-md-6">
                                <input class="form-control" list="proveedores"
                                       name="proveedor" id="proveedor" value="{{old('proveedor')}}">
                                <datalist id="proveedores">
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{$proveedor->empresa->denominacion}}">
                                    @endforeach
                                </datalist>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 text-right" for="insumoTrazable">Insumo trazable</label>
                            <div class="col-md-6">
                                <input class="form-control" list="insumosTrazables"
                                       name="insumoTrazable" id="insumoTrazable" value="{{old('insumoTrazable')}}">
                                <datalist id="insumosTrazables">
                                    @foreach($insumos as $insumo)
                                        <option value="{{$insumo->insumo->descripcion}}">
                                    @endforeach
                                </datalist>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Registrar') }}
                                </button>
                                <a class="btn btn-secondary btn-block" href="{{route('insumos.index')}}">Volver</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
