@extends('layouts.app')

@section('content')
<section class="container">
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
            {{-- @foreach ($roles as $rol)
                <tr>
                    <th scope="row">{{$rol->id}}</th>                
                    <td>{{$rol->name}}</td>
                    <td>{{$rol->descr}}</td>                    
                    <td>{{$rol->activo}}</td>
                    <td>
                        <a href="{{route('roles.edit', $rol)}}" class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{route('roles.destroy', $rol)}}" method="POST" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach --}}
        </tbody>
      </table>
    </section>
@endsection
