@extends('layouts.app')

@section('content')
<section class="container">
    <a href="{{route('ingresos.index')}}" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Ingresos</h5>
        </div>
        <p class="mb-1">Menú de ingresos.</p>
    </a>

    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Salidas</h5>
        </div>
        <p class="mb-1">Menú de salidas.</p>
    </a>

</section>
@endsection
