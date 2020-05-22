
@extends('layouts.app')
@section('publics')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/notifCartel.js') }}"></script>
    <script src="{{ asset('js/errorCartel.js') }}"></script>
    <script src="{{ asset('js/permisoscreate.js') }}"></script>
@endsection
@section('content')
<div class="container">
        <div class="bs-example">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" >Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.menu')}}" >Admin</a></li>
                <li class="breadcrumb-item"><a href="{{route('permisos.index')}}" >Gestion de permisos</a></li>
                <li class="breadcrumb-item active">Agregar permiso</li>
            </ol>
        </nav>
        </div>  
    <div class="row justify-content-center">
        <div class="col-md-8">
            
                @if (session('mensaje'))
                    <div class="">
                       <p class="alertajs" style="display:none"> {{ session('mensaje') }} </p> 
                    </div>
                @endif

                @if (session('error'))
                    <div class="">
                       <p class="errorjs" style="display:none"> {{ session('error') }} </p> 
                    </div>
                @endif

            <div class="card">
                <div class="card-header text-center h2">{{ __('Registro de permisos') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('permisos.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nombrePermiso" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="nombrejs form-control" name="name" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="descr" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                            <div class="col-md-6">
                                <input id="descr" type="text" class="observacionjs form-control" name="descr" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="funcionalidad" class="col-md-4 col-form-label text-md-right">{{ __('Funcionalidad') }}</label>

                            <div class="col-md-6">
                                <input id="funcionalidad" type="text" class="observacionjs form-control" name="funcionalidad" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block mt-3">
                                    {{ __('Registrar') }}
                                </button>
                                <a class="btn btn-secondary btn-block mt-3" href="{{route('permisos.index')}}">Volver</a>
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection