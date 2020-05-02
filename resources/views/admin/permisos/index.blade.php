@extends('layouts.app')

@section('content')
<section class="container">
    <section>
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" >Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.menu')}}" >Admin</a></li>
                    <li class="breadcrumb-item active">Gestion de permisos</li>
                </ol>
            </nav>
        </div>

        <a class="btn btn-primary btn-sm m-1" href="{{route('permisos.create')}}">Agregar</a>

        <nav class="float-right">
            <form class="form-inline">
                <input name='name' class="form-control mr-sm-2" type="search" placeholder="Nombre" aria-label="buscar por nombre">
                <input name='descr' class="form-control mr-sm-2" type="search" placeholder="Descr" aria-label="buscar por descripcion">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>
        </nav>
    </section>

    <section class="mt-3">
        <table class="table">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{$errors->first()}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('mensaje'))
                    <div class="alert alert-success">
                        {{session('mensaje')}}
                    </div>
                @endif
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Activo</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($permisos as $permiso)
                        <tr>
                            <th scope="row">{{$permiso->id}}</th>
                            <td>{{$permiso->nombre_ruta}}</td>
                            <td>{{$permiso->descr}}</td>
                            <td>{{$permiso->trashed() ? "No": "Si"}}</td>
                            <td>{{$permiso->funcionalidad}}</td>
                            <td>
                                <a href="{{route('permisos.edit', $permiso)}}" class="btn btn-warning btn-sm">Editar</a> <!--me tira que permisos.edit no existe -->
                                @if (!$permiso->trashed())
                                    <form action="{{route('permisos.destroy', $permiso)}}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                @else
                                    <a class="btn btn-success btn-sm" href="{{route('permisos.activate',$permiso->id)}}">Activar</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
              </table>
            <div class="row justify-content-center">
                {{$permisos->links()}}
            </div>
    </section>
      <a class="btn btn-secondary btn-sm" href="{{route('admin.menu')}}">Volver</a>

    </section>
@endsection
