@extends('layouts.app')

@section('publics')
    <script src="{{ asset('js/precioXkg.js') }}"></script>
@endsection
@section('content')

<div class="container">
    <div class="bs-example">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" >Home</a></li>
            </ol>
        </nav>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="tarjeta card">
            <div class="card-header text-center h2">
            </div>
            <div class="card-body">
                <form action="" method="POST" >


                <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="precioXkg">Precio por KG</label>
                        <div class="col-md-6">
                            <input class="precioxkg form-control" type="text" id="precio_por_kilo" name="precio_por_kilo" required>
                        </div>

                        <span class="invalid-feedback">
                            <strong>asdasdasdasd</strong>
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
                            <button class="btn btn-secondary col-sm-3">Cancelar</button>
                            <button class="boton btn btn-primary col-sm-3 offset-md-6">Registrar</button>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
