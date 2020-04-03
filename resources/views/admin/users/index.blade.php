@extends('layouts.app')

@section('content')

<section class="container">

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
            <th scope="col">Username</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Email</th>
            <th scope="col">Activo</th>
            <th scope="col">Acciones</th>            
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>                
                    <td>{{$user->username}}</td>
                    <td>{{$user->descr}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->activo}}</td>
                    <td>
                        <a href="{{route('users.edit', $user)}}" class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{route('users.destroy', $user)}}" method="POST" class="d-inline">
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