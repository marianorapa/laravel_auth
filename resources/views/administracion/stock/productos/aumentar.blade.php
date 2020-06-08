@extends('layouts.app')
@section('publics')
    <script src="{{ asset('js/createFormulajs.js') }}"></script>
    <script
        src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.5/dist/latest/bootstrap-autocomplete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/notifCartel.js') }}"></script>
    <script src="{{ asset('js/errorCartel.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('administracion.menu')}}">Administración</a></li>
                    <li class="breadcrumb-item"><a href="{{route('administracion.stock')}}">Stock</a></li>
                    <li class="breadcrumb-item"><a href="{{route('administracion.stock.productos')}}">Gestión de Stock
                            de
                            Productos</a></li>
                    <li class="breadcrumb-item active">Ajuste de stock</li>

                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div class="">
                    <p class="errorjs" style="display:none">{{ $errors->first() }}</p>
                </div>
            @endif

            <div class="card">
                <div class="card-header text-md-center h3">Ajuste de stock producto</div>

                <div class="card-body">
                    <form action="{{route('administracion.stock.productos.ajustar.post', $producto->id)}}" method="POST">
                        @csrf
                        <div class="form-inline">
                            <label for="cliente" class="col-form-label col-2">Cliente</label>
                            <input id="cliente" type="text" class="form-control col-9" name="cliente"
                                   value="{{$producto->cliente}}" readonly>
                        </div>

                        <div class="form-inline mt-4">
                            <label for="producto" class="col-form-label col-2">Producto</label>
                            <input id="producto" type="text" class="form-control col-6" name="producto"
                                   value="{{$producto->producto}}" readonly>
                        </div>

                        <div class="form-inline mt-4">
                            <label for="stock" class="col-form-label col-2">Stock actual</label>
                            <input id="stock" type="text" class="form-control col-2" name="stock"
                                   value="{{$producto->stock}}" readonly>
                            <label class="ml-2">kgs</label>
                        </div>

                        <div class="form-inline mt-4">
                            <label for="ajuste" class="col-form-label col-2">*Ajuste:</label>
                            <input id="ajuste" type="number" class="form-control col-3" name="ajuste"
                                   placeholder="Ej. 5000 o -3500">
                            <label class="ml-2">kgs</label>

                        </div>
                        <label class="text-info mt-3 ml-4">*Cantidad negativa para restar stock</label>

                        <div class="form-inline mt-5">
                            <a class="btn btn-secondary col-2"
                               href="{{route('administracion.stock.productos')}}">Cancelar</a>
                            <button type="submit" class="btn btn-primary col-2 offset-8">Registrar</button>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>

@endsection
