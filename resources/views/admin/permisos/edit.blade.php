@extends('layouts.app')
@section('publics')
    <script src="{{ asset('js/permisoscreate.js') }}"></script>
@endsection
@section('content')
    <section class="container">
        <div class="bs-example">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" >Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.menu')}}" >Admin</a></li>
                <li class="breadcrumb-item"><a href="{{route('permisos.index')}}" >Gestion de permisos</a></li>
                <li class="breadcrumb-item active">Editar permiso</li>
            </ol>
        </nav>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center h2">
                        Editar persona
                    </div>
                    <div class="card-body">
                        <form action="{{route('permisos.update', $permiso->id)}}" method="POST">
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

                            <div class="form-group">
                                <label for="name">Nombre</label>

                                <input type="text" name="name" id="name"
                                value="{{$permiso->nombre_ruta}}" placeholder="Nombre"
                                class="nombrejs form-control mb-2" required>
                            </div>


                            <div class="form-group">
                                <label for="descr">Descripción</label>
                                <input type="text" name="descr" id="descr"
                                value="{{$permiso->descr}}"
                                placeholder="Descripcion" value="{{$permiso->descr}}" class="observacionjs form-control mb-2" required>
                            </div>

                            <div class="form-group">
                                <label for="funcionalidad">Funcionalidad</label>
                                <input type="text" name="funcionalidad" id="funcionalidad"
                                value="{{$permiso->funcionalidad}}" placeholder="Acciones"
                                class="observacionjs form-control mb-2" required>
                            </div>


                            <input type="submit" value="Actualizar permiso" class="btn btn-primary btn-block mt-3">
                            <a class="btn btn-secondary btn-block mt-4" href="{{route('permisos.index')}}">Volver</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
