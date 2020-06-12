@extends('layouts.app')
@section('publics')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/notifCartel.js') }}"></script>
    <script src="{{ asset('js/errorCartel.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" >Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('administracion.menu')}}" >Administración</a></li>
                    <li class="breadcrumb-item"><a href="{{route('administracion.empresas')}}" >Gestión de Empresas</a></li>

                    <li class="breadcrumb-item active">Nueva Empresa</li>

                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{$errors->first()}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
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

            <div class="card">
                <div class="card-header text-center h2">{{ __('Registro de empresa') }} </div>

                <div class="card-body">
                    <form action="{{route('empresas.store')}}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="denominacion" class="col-md-4 col-form-label text-md-right">Denominación</label>
                            <div class="col-md-6">
                                <input id="denominacion" type="text" class="form-control" name="denominacion" value="{{old('denominacion')}}" required>
                                @error('denominacion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Denominacion invalida</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tipo_empresa" class="col-md-4 col-form-label text-md-right">Tipo de Empresa</label>
                            <div class="col-md-6">
                                <select name="tipo_empresa" id="tipo_empresa" class="form-control" required>
                                    <option data-tokens=="0" selected="true" disabled="disabled">Seleccione</option>
                                    <option value="cliente">Cliente</option>
                                    <option value="proveedor">Proveedor</option>
                                    <option value="transportista">Transportista</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gln" class="col-md-4 col-form-label text-md-right">GLN</label>
                            <div class="col-md-6">
                            <input id="gln" type="text" class="form-control" name="gln" value="{{old('gln')}}">
                                @error('gln')
                                <span class="invalid-feedback" role="alert">
                                    <strong>GLN invalida</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        @include('comun.personas_tipo.inputs-create')
                        @include('comun.domicilios.inputs-create')


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Registrarse') }}
                                </button>
                                <a class="btn btn-secondary btn-block" href="{{route('empresas.index')}}">Volver</a>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection
