@extends('layouts.app')

@section('content')
<section class="container">
    <a href="{{route('pedidos.index')}}" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Pedidos</h5>
        </div>
        <p class="mb-1">Menú de gestión de pedidos/órdenes de producción.</p>
    </a>
{{--    {{route('despachos.index')}}--}}
    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Productos</h5>
        </div>
        <p class="mb-1">Menú de gestión de productos y fórmulas.</p>
    </a>

</section>
@endsection
