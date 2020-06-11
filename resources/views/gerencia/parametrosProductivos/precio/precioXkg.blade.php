@extends('layouts.app')

@section('publics')
    <script src="{{ asset('js/precioXkg.js') }}"></script>
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
                <li class="breadcrumb-item"><a href="{{route('gerencia.index')}}">Gerencia</a></li>
                <li class="breadcrumb-item"><a href="/gestionParametrosProductivos" >Parámetros</a></li>
                <li class="breadcrumb-item"><a href="{{route('parametros.precio.index')}}" >Gestión de precios</a></li>
                <li class="breadcrumb-item active">Nuevo precio</li>
            </ol>
        </nav>
    </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        {{$errors->first()}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('message'))
    <div class="">
        <p class="alertajs" style="display:none"> {{ session('mensaje') }} </p>
    </div>
@endif

@if (session('error'))
    <div class="">
        <p class="errorjs" style="display:none"> {{ session('error') }} </p>
    </div>
@endif
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="tarjeta card">
            <div class="card-header text-center h2">
            </div>
            <div class="card-body">
                <form action="{{route('parametros.precio.post')}}" method="POST" >
                    @csrf
                <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="precioXkg">Precio por tonelada</label>
                        <div class="col-md-6">
                            <input class="precioxkg form-control" type="text" id="precio_por_tn" name="precio_por_tn" required>
                        </div>

                        <span class="invalid-feedback">
                            <strong>Error</strong>
                        </span>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="variacion">Variacion</label>
                    <div class="col-md-6">
                        <input class="variacion form-control" type="text" id="variacion" name="variacion" placeholder="%" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="fechaDesde">Fecha desde</label>
                    <div class="col-md-6">
                        <input class="fecha_desde form-control" type="date" id="fecha_desde" name="fecha_desde" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="fechaHasta">Fecha hasta</label>
                    <div class="col-md-6">
                        <input class="fecha_hasta form-control" type="date" id="fecha_hasta" name="fecha_hasta" >
                    </div>
                </div>
                <br>

                <div class="form-inline row">
                    <a class="btn btn-secondary col-sm-3" href="{{route('parametros.precio.index')}}">Cancelar</a>
                    <button class="boton btn btn-primary col-sm-3 offset-md-6">Registrar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
