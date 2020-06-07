@extends('layouts.app')
@section('publics')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/sweetAlert2.js') }}"></script>
    <script src="{{ asset('js/notifCartel.js') }}"></script>
    <script src="{{ asset('js/errorCartel.js') }}"></script>
@endsection


@section('content')
    @inject('AlimentoTipo', 'App\alimentoTipo')

    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">

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

            @if (session('mensaje'))
                <div class="" role="alert">
                    <p class="alertajs" style="display:none">{{ session('message') }}</p>
                </div>
            @endif


    <div class="card">
        <div class="card-header text-center h2">{{ __('Registro de producto') }}</div>

        <div class="card-body">
            <form method="POST" action="">
                @csrf

                <div class="form-group row">
                    <label for="descripcion" class="col-md-3 col-form-label text-md-right">{{ __('Descripcion') }}</label>

                    <div class="col-md-6">
                        <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{old('descripcion')}}" required>
                        @error('descripcion')
                            <span class="invalid-feedback" role="alert">
                                <strong>descripcion invalido</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="Tipo" class="col-md-3 col-form-label text-md-right">{{ __('Tipo') }}</label>

                    <div class="col-md-6">
                        {{--<input id="apellidos" type="text" class="apellidosjs form-control" name="apellidos"
                                value="{{old('apellidos')}}" required>--}}
                        <select name="tipo" id="tipo" class="custom-select">
                            @foreach($AlimentoTipo->getAlimentoTipo() as $index=> $tipo)
                                <option value="{{$index}}">{{$tipo}}</option>

                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Registrar') }}
                        </button>
                        <a class="btn btn-secondary btn-block" href="">Volver</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
    </div>
@endsection
