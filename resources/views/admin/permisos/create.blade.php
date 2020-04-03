@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{ __('Registro de permisos') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('permisos.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nombrePermiso" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="descr" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                            <div class="col-md-6">
                                <input id="descr" type="text" class="form-control" name="descr" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="funcionalidad" class="col-md-4 col-form-label text-md-right">{{ __('Funcionalidad') }}</label>

                            <div class="col-md-6">
                                <input id="funcionalidad" type="text" class="form-control" name="funcionalidad" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection