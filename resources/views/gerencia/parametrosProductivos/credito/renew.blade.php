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
                <li class="breadcrumb-item"><a href="/gestionParametrosProductivos" >Parámetros</a></li>
                <li class="breadcrumb-item"><a href="{{route('parametros.credito.index')}}" >Gestion de crédito</a></li>
                <li class="breadcrumb-item active">Renovar crédito cliente</li>
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
                <h5 class="mb-1">Definir crédito cliente</h5>
            </div>
            <div class="card-body">
                <form action="{{route('parametros.credito.post')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="idCliente">Cliente</label>
                        <div class="col-md-6">
                            <input class="form-control" type="text"
                                   id="cliente" name="cliente" placeholder="Cliente"
                                   value="{{$credito->cliente}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="idCliente">Nuevo límite:</label>
                        <div class="col-md-6">
                            <input class="form-control col-md-5" type="number"
                                   id="limite" name="limite" placeholder="Límite kgs" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="desde">Desde:</label>
                        <div class="col-md-6">
                            <input class="form-control" type="date"
                                   id="desde" name="desde" placeholder="desde" required>
                        </div>
                    </div>

                    <div class="form-inline row">
                        <a class="btn btn-secondary col-sm-3 " href="{{route('parametros.credito.index')}}">Cancelar</a>
                        <button type="submit" class="btn btn-primary col-sm-3 offset-md-6">Registrar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
