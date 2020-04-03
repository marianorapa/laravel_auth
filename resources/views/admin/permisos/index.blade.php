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
             @foreach ($permisos as $permiso)
                <tr>
                    <th scope="row">{{$permiso->id}}</th>                
                    <td>{{$permiso->name}}</td>
                    <td>{{$permiso->descr}}</td>                    
                    <td>{{$permiso->activo}}</td>
                    <td>{{$permiso->funcionalidad}}</td>
                    <td>
                        <a href="{{route('$permisos.edit', $permiso)}}" class="btn btn-warning btn-sm">Editar</a> <!--me tira que permisos.edit no existe -->

                        <form action="{{route('$permisos.destroy', $permiso)}}" method="POST" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </section>
@endsection
