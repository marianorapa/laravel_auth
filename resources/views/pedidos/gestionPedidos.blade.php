@extends('layouts.app')

@section('content')


<section class="container">
    <div class="bs-example">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/main" >Home</a></li>
            </ol>
        </nav>
    </div>


    <div class="list-group">
        
            <div class="d-flex w-100 justify-content-between">
            <a href="{{route('finPedido')}}" class="list-group-item list-group-item-action flex-column align-items-start">
                <h5 class="mb-1">Finalizar pedido</h5>
                <p class="mb-1">Finalizar un pedido en proceso.</p>
            </div>
        </a>
    </div>



</section>
@endsection