@extends('layouts.app')

@section('content')
<section class="container">

    <div class="bs-example">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('administracion.menu')}}">Administración</a></li>
                <li class="breadcrumb-item active">Stock</li>
            </ol>
        </nav>
    </div>

    <a href="{{route('administracion.stock.insumos')}}" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Insumos</h5>
        </div>
        <p class="mb-1">Stock de insumos.</p>
    </a>
{{--    {{route('despachos.index')}}--}}
    <a href="{{route('administracion.stock.productos')}}" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Productos</h5>
        </div>
        <p class="mb-1">Stock de productos.</p>
    </a>


</section>
@endsection
