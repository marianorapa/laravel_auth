@extends('layouts.app')

@section('content')
<section class="container">
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
                    <td>{{$rol->activo}}</td>
                    <td>
                        <a href="{{route('roles.edit', $rol)}}" class="btn btn-warning btn-sm">Editar</a>                        
                        @if ($rol->activo)
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
</section>
@endsection
