@extends('layouts.app')

@section('content')
<div class="container">
    <div class="bs-example">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" >Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.menu')}}" >Admin</a></li>
                <li class="breadcrumb-item"><a href="{{route('personas.index')}}" >Gestion de persona</a></li>
                <li class="breadcrumb-item active">Agregar persona</li>
            </ol>
        </nav>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            @endif
            
            @if (session('mensaje'))
            <div class="alert alert-success" role="alert">
                {{ session('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            @endif

            <div class="card">
                <div class="card-header">{{ __('Registro de persona') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('personas.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nombresPersona" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>

                            <div class="col-md-6">
                                <input id="nombresPersona" type="text" class="form-control" name="nombresPersona" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="apellidos" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

                            <div class="col-md-6">
                                <input id="apellidos" type="text" class="form-control" name="apellidos" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="descr" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                            <div class="col-md-6">
                                <input id="descr" type="text" class="form-control" name="descr" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fechaNac" class="col-md-4 col-form-label text-md-right">{{ __('Fecha nacimiento') }}</label>

                            <div class="col-md-6">
                                <input id="fechaNac" type="date" class="form-control" name="fechaNac" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="direccion" class="col-md-4 col-form-label text-md-right">{{ __('Domicilio') }}</label>

                            <div class="col-md-6">
                                <input id="direccion" type="text" class="form-control" name="direccion" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                            <div class="col-md-6">
                                <input id="tel" type="tel" class="form-control" name="tel" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="tipoDoc" class="col-md-4 col-form-label text-md-right">Tipo Documento</label>
                           <div class="col-md-6">
                                <select name="tipoDoc" id="tipoDoc" class="form-control">
                                    <option value="DNI">DNI</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nroDocumento" class="col-md-4 col-form-label text-md-right">{{ __('nroDocumento') }}</label>

                            <div class="col-md-6">
                                <input id="nroDocumento" type="text" class="form-control" name="nroDocumento" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Registrarse') }}
                                </button>
                                <a class="btn btn-secondary btn-block" href="{{route('personas.index')}}">Volver</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection