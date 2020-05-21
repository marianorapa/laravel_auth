@extends('layouts.app')


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/sweetAlert2.js') }}"></script>
    <script src="{{ asset('js/notifCartel.js') }}"></script>
    <script src="{{ asset('js/errorCartel.js') }}"></script>

@section('content')

<section class="container">
    <div class="bs-example">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" >Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.menu')}}" >Admin</a></li>
                <li class="breadcrumb-item active">Gestion de usuarios</li>
            </ol>
        </nav>
    </div>
    <nav class="navbar navbar-light float-right">
        <form class="form-inline">
            <input name='name' class="form-control mr-sm-2" type="search" placeholder="Nombre" aria-label="buscar por nombre">
            <input name='email' class="form-control mr-sm-2" type="search" placeholder="Email" aria-label="buscar por email">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
    </nav>
<a class="btn btn-primary btn-sm m-1" href="{{route('users.create')}}">Agregar</a>
    <table class="table">
        @if ($errors->any())
        <div class="">
             <p class="errorjs" style="display:none">{{$errors->first()}}</p> 
            <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>-->
            </button>
        </div>
        @endif

        @if (session('mensaje'))
        <div class="">
        <p class="alertajs" style="display:none">{{session('mensaje')}}</p> 
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
                    <td>{{$user->descripcion}}</td>
                    <td>{{$user->persona()->first()->personaTipo()->first()->email}}</td>
                    <td>{{$user->trashed() ? "No": "Si"}}</td>
                    <td>
                        <a href="{{route('users.edit', $user)}}" class="btn btn-warning btn-sm">Editar</a>
                        @if (!$user->trashed())
                            <form method="post" id="destroy-appointment-{{ $user }}" action="{{route('users.destroy', $user)}}" onSubmit="return confirm('Desea eliminar?');">
                                        <input type="hidden" name="id" value={{ $user }}>
                                        @method('DELETE')
                                        @csrf
                                        <button class ="btn btn-danger btn-sm" type="submit" form="destroy-appointment-{{ $user }}">Eliminar</button>
                            </form>
                        @else
                            <a class="btn btn-success btn-sm" href="{{route('users.activate',$user->id)}}">Activar</a>
                        @endif
                    </td>
                </tr>
            @endforeach

        </tbody>

      </table>
    <a class="btn btn-secondary btn-sm" href="{{route('admin.menu')}}">Volver</a>
    </section>
@endsection
