@extends('layouts.app')

@section('content')
<section class="container">
    <div class="bs-example">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Administración</li>
            </ol>
        </nav>
    </div>

    <a href="{{route('pedidos.index')}}" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Pedidos</h5>
        </div>
        <p class="mb-1">Menú de gestión de pedidos/órdenes de producción.</p>
    </a>

    <a href="{{route('administracion.stock')}}" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Stock</h5>
        </div>
        <p class="mb-1">Menú de stock de insumos y productos de clientes.</p>
    </a>

    <a href="{{route('administracion.empresas')}}" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Empresas</h5>
        </div>
        <p class="mb-1">Menú de gestión de clientes, proveedores y transportistas.</p>
    </a>

    <a href="{{route('administracion.prestamos.index')}}" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Préstamos</h5>
        </div>
        <p class="mb-1">Menú de visualización de préstamos.</p>
    </a>
    <a href="{{route('producto.index')}}" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Productos</h5>
        </div>
        <p class="mb-1">Menú de visualización de productos.</p>
    </a>
    <a href="{{route('formula.index')}}" class="list-group-item list-group-item-action flex-column align-items-start">{{--por ahora solo lleva al index de formula--}}
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Fórmulas</h5>
        </div>
        <p class="mb-1">Menú de gestión de fórmulas de productos.</p>
    </a>
    <a href="{{route('insumos.index')}}" class="list-group-item list-group-item-action flex-column align-items-start">{{--por ahora solo lleva al index de formula--}}
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Insumos</h5>
        </div>
        <p class="mb-1">Menú de gestión de insumos.</p>
    </a>

</section>
@endsection
