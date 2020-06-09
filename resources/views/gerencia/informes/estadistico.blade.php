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
                    <li class="breadcrumb-item"><a href="{{route('gerencia.index')}}">Gerencia</a></li>
                    <li class="breadcrumb-item active">Informe estadístico</li>
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
                <div class="card-header text-md-center h3">Generación informe estadístico</div>

                <div class="card-body">
                    <form method="POST" action="{{route('informes.estadistico.generar')}}">
                        @csrf
                        <div class="form-inline mt-4">
                            <label for="desde" class="col-form-label col-2">Fecha desde</label>
                            <input id="desde" type="date" class="form-control col-3" name="desde">

                            <label for="hasta" class="col-form-label col-2 offset-1">Fecha hasta</label>
                            <input id="hasta" type="date" class="form-control col-3" name="hasta">
                        </div>

                        <div class="form-inline mt-5">
                            <a class="btn btn-secondary col-2"
                               href="{{route('gerencia.index')}}">Cancelar</a>
                            <button type="submit" class="btn btn-primary col-2 offset-8">Generar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
