@extends('layouts.app')

@section('content')

<section class="container">
    <div class="bs-example">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" >Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.menu')}}" >Admin</a></li>
                <li class="breadcrumb-item"><a href="{{route('personas.index')}}" >Gestion de persona</a></li>
                <li class="breadcrumb-item active">Editar persona</li>
            </ol>
        </nav>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar persona
                </div>
                <div class="card-body">
                    <form action="{{route('personas.update', $persona->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                        @error('nombre')
                        <div class="alert alert-danger">
                            El nombre es obligatorio!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @enderror

                        @error('descripcion')
                            <div class="alert alert-danger">
                                La descripcion es obligatoria!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror

                        @if (session('mensaje'))
                            <div class="alert alert-success">
                                {{session('mensaje')}}
                            </div>
                        @endif

                        @include('admin.personas.inputs-edit', ['persona' => $persona])


                        <input type="submit" value="Actualizar persona" class="btn btn-primary btn-block mt-3">
                        <a class="btn btn-secondary btn-block mt-4" href="{{route('personas.index')}}">Volver</a>
                    </form>

                </div>
            </div>
        </div>
    </section>


@endsection
