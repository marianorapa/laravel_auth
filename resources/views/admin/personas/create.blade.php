@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/sweetAlert2.js') }}"></script>
    <script src="{{ asset('js/notifCartel.js') }}"></script>
    <script src="{{ asset('js/errorCartel.js') }}"></script>
@section('content')
@inject('Provincia', 'App\Provincia')

<div class="container">
    <div class="bs-example">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" >Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.menu')}}" >Admin</a></li>
                <li class="breadcrumb-item"><a href="{{route('personas.index')}}">Gestion de persona</a></li>
                <li class="breadcrumb-item active">Agregar persona</li>
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
               <p class="alertajs" style="display:none">{{ session('mensaje') }}</p>
            </div>
            @endif



            <div class="card">
                <div class="card-header text-center h2">{{ __('Registro de persona') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('personas.store') }}">
                        @csrf

                        @include('admin.personas.inputs-create');


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Registrarse') }}
                                </button>
                                <a class="btn btn-secondary btn-block" href="{{route('personas.index')}}">Volver</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
