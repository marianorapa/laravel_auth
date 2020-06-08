@extends('layouts.app')

@section('content')
<section class="container">
    <div class="bs-example">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Gerencia</li>
            </ol>
        </nav>
    </div>

    <a href="{{route('parametros.index')}}" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Parámetros</h5>
        </div>
        <p class="mb-1">Menú de definición de parámetros productivos.</p>
    </a>
{{--    {{route('despachos.index')}}--}}
    <a href="{{route('informes.estadistico')}}" class="list-group-item list-group-item-action flex-column align-items-start">{{--por ahora solo lleva al index de formula--}}
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Informes</h5>
        </div>
        <p class="mb-1">Menú de generación de informes.</p>
    </a>

</section>
@endsection
