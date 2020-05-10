@extends('layouts.app')
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
        <div class="card">
            <div class="card-header text-center h2">
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    
                
                <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="capacidadProductiva">Capacidad productiva</label>
                        <div class="col-md-6">
                            <input class="form-control" type="text" id="capacidad" name="capacidad" required>
                        </div>                      
                </div>

                <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="fechaDesde">Fecha desde</label>
                        <div class="col-md-6">
                            <input class="form-control" type="date" id="fecha_desde" name="fecha_desde" required>
                        </div>                      
                </div>

                <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="fechaHasta">Fecha hasta</label>
                        <div class="col-md-6">
                            <input class="form-control" type="date" id="fecha_hasta" name="fecha_hasta" >
                        </div>                      
                </div>
                <br>

                <div class="form-inline row">
                            <button class="btn btn-secondary col-sm-3">Cancelar</button>
                            <button class="btn btn-primary col-sm-3 offset-md-6">Registrar</button>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection