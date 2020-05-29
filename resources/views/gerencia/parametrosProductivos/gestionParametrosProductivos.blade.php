@extends('layouts.app')

@section('content')


<section class="container">
    <div class="bs-example">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/main" >Home</a></li>
                <li class="breadcrumb-item active">Parámetros</li>
            </ol>
        </nav>
    </div>


    <div class="list-group">
        <a href="{{route('parametros.precio.index')}}" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">Definir precio por KG</h5>
            </div>
            <p class="mb-1">Definir el precio de referencia del servicio.</p>
        </a>
    </div>

    <div class="list-group">
        <a href="{{route('parametros.capacidad.index')}}" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">Definir capacidad productiva</h5>
            </div>
            <p class="mb-1">Definir la capacidad productiva prevista entre fechas determinadas.</p>
        </a>
    </div>


</section>
@endsection
