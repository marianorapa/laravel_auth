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

                    <li class="breadcrumb-item active">Nuevo Insumo</li>
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
                    <p class="errorjs" style="display:none">Ambos datos son obligatorios</p>
                </div>
            @endif

            <div class="card">
                <div class="card-header text-center h3">{{ __('Registro de Insumo') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('insumos.store.normal')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="descripcion"
                                   class="col-md-3 col-form-label text-md-right">{{ __('Descripción') }}</label>

                            <div class="col-md-6">
                                <input id="descripcion" type="text" class="form-control" name="descripcion"
                                       value="{{old('descripcion')}}" required>
                            </div>
                        </div>

                        <div class="form-group row offset-2">
                            <label class="col-form-label mr-5">Tipo</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isTrazable" id="isTrazable"
                                       value="true">
                                <label class="form-check-label mr-5" for="isTrazable">Trazable</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isTrazable" id="isNotTrazable"
                                       value="false">
                                <label class="form-check-label" for="isNotTrazable">No Trazable</label>
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
