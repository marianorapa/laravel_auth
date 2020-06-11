@extends('layouts.app')
@section('publics')
    <script src="{{ asset('js/capacidadProductiva.js') }}"></script>
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
                <li class="breadcrumb-item"><a href="{{route('parametros.capacidad.index')}}" >Gestion de capacidad productiva</a></li>
                <li class="breadcrumb-item active">Nuevo Capacidad producctiva</li>
            </ol>
        </nav>
    </div>
</div>


<div class="row justify-content-center">
    <div class="col-md-4">

        @if ($errors->any())
            <div class="alert alert-danger">
                {{$errors->first()}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="">
                <p class="errorjs" style="display:none">{{ session('error') }}</p>
            </div>
        @endif

        @if (session('mensaje'))
            <div class="" role="alert">
                <p class="alertajs" style="display:none">{{ session('mensaje') }}</p>
            </div>
        @endif

        <div class="card">
            <div class="card-header text-center h2">
                <h5 class="mb-1">Definir capacidad productiva</h5>
            </div>
            <div class="card-body">
                <form action="{{route('parametros.capacidad.post')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="capacidadProductiva">Capacidad productiva</label>
                        <div class="col-md-6">
                            <input class="capacidadjs form-control" type="text"
                                   id="capacidad" name="capacidad" placeholder="Kgs por día" required>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="fechaDesde">Fecha desde</label>
                        <div class="col-md-6">
                            <input class="fechadesdejs form-control" type="date" id="fecha_desde" name="fecha_desde" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Tipo:</label>
                        <div class="col-md-8">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_capacidad" id="radioPermanente"
                                       value="permanente" checked>
                                <label class="form-check-label" for="radioPermanente">
                                    Permanente
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_capacidad" id="radioTemporal"
                                       value="temporal">
                                <label class="form-check-label" for="radioTemporal">
                                    Temporal
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="fechaHasta">Fecha hasta</label>
                        <div class="col-md-6">
                            <input class="fechahastajs form-control" type="date" id="fecha_hasta" name="fecha_hasta" >
                        </div>
                    </div>
                    <br>

                    <div class="form-inline row">
                        <a class="btn btn-secondary col-sm-3 " href="{{route('parametros.capacidad.index')}}">Cancelar</a>
                        <button class="btn btn-primary col-sm-3 offset-md-6">Registrar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
