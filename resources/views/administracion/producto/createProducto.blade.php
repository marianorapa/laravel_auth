@extends('layouts.app')
@section('publics')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/sweetAlert2.js') }}"></script>
    <script src="{{ asset('js/notifCartel.js') }}"></script>
    <script src="{{ asset('js/errorCartel.js') }}"></script>
@endsection


@section('content')
    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" >Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('administracion.menu')}}" >Administración</a></li>
                    <li class="breadcrumb-item"><a href="{{route('producto.index')}}" >Gestión de Productos</a></li>

                    <li class="breadcrumb-item active">Nuevo producto</li>

                </ol>
            </nav>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('error'))
                <div class="" role="alert">
                    <p class="errorjs" style="display:none">{{ session('error') }}</p>
                </div>
            @endif

            @if (session('message'))
                <div class="" role="alert">
                    <p class="alertajs" style="display:none">{{ session('message') }}</p>
                </div>
            @endif


    <div class="card">
        <div class="card-header text-center h2">{{ __('Registro de producto') }}</div>

        <div class="card-body">
            <form method="POST" action="{{route('producto.store')}}">
                @csrf

                <div class="form-group row">
                    <label for="ClienteLabel" class="col-md-3 col-form-label text-md-right">{{ __('Cliente') }}</label>

                    <div class="col-md-6">
                        {{--<input id="apellidos" type="text" class="apellidosjs form-control" name="apellidos"
                                value="{{old('apellidos')}}" required>--}}
                        <select name="cliente" id="cliente" class="custom-select @error('cliente') is-invalid @enderror">
                            <option data-tokens=="0" selected="true" disabled="disabled">Seleccione</option>
                            @foreach($clientes as $cliente)
                                <option value="{{$cliente->id}}">{{$cliente->denominacion}}</option>

                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="TipoLabel" class="col-md-3 col-form-label text-md-right">{{ __('Tipo') }}</label>

                    <div class="col-md-6">
                        {{--<input id="apellidos" type="text" class="apellidosjs form-control" name="apellidos"
                                value="{{old('apellidos')}}" required>--}}
                        <select name="tipo" id="tipo" class="custom-select @error('tipo') is-invalid @enderror">
                            <option data-tokens=="0" selected="true" disabled="disabled">Seleccione</option>
                            @foreach($tipos as $tipo)
                                <option value="{{$tipo->id}}">{{$tipo->descripcion}}</option>

                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="descripcionLabel" class="col-md-3 col-form-label text-md-right">{{ __('Descripcion') }}</label>

                    <div class="col-md-6">
                        <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{old('descripcion')}}" required>
                        @error('descripcion')
                            <span class="invalid-feedback" role="alert">
                                <strong>descripcion invalido</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="gtinLabel" class="col-md-3 col-form-label text-md-right">{{ __('Gtin') }}</label>

                    <div class="col-md-6">
                        <input id="gtin" type="text" class="form-control @error('gtin') is-invalid @enderror" name="gtin" value="{{old('gtin')}}" pattern="[0-9]{0,10}" >
                        @error('gtin')
                        <span class="invalid-feedback" role="alert">
                                <strong>Gtin invalido</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Registrar') }}
                        </button>
                        <a class="btn btn-secondary btn-block" href="{{route('producto.index')}}">Volver</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
    </div>
@endsection
