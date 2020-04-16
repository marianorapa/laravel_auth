@extends('layouts.app')

@section('content')
<section class="container">
    <div class="bs-example">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" >Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.menu')}}" >Admin</a></li>
                <li class="breadcrumb-item active">Gestion de roles</li>
            </ol>
        </nav>
    </div>

    <nav class="navbar navbar-light float-right">
        <form class="form-inline">
            <input name='name' class="form-control mr-sm-2" type="search" placeholder="Nombre" aria-label="buscar por nombre">
            <input name='descr' class="form-control mr-sm-2" type="search" placeholder="Descr" aria-label="buscar por descripcion">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
    </nav>
    
    @if (session('mensaje'))
    <div class="alert alert-success">
        {{session('mensaje')}}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
    @endif
    <a class="btn btn-primary btn-sm m-1" href="{{route('roles.create')}}">Agregar</a>
    <table class="table">
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
            @foreach ($roles as $rol)
                <tr>
                    <th scope="row">{{$rol->id}}</th>
                    <td>{{$rol->name}}</td>
                    <td>{{$rol->descr}}</td>
                    <td>{{$rol->trashed() ? "No": "Si"}}</td>
                    <td>
                        <a href="{{route('roles.edit', $rol)}}" class="btn btn-warning btn-sm">Editar</a>
                        @if (!$rol->trashed())
                            <form action="{{route('roles.destroy', $rol)}}" method="POST" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                        @else
                            <a class="btn btn-success btn-sm" href="{{route('roles.activate',$rol->id)}}">Activar</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
      <a class="btn btn-secondary btn-sm" href="{{route('admin.menu')}}">Volver</a>
    </section>
@endsection
