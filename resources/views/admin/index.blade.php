@extends('layouts.app')

@section('content')
<section class="container">
    <ul>
        <li>
            <a href="{{route('users.index')}}">Gestión de usuarios</a>
        </li>
        <li>
            <a href="{{route('roles.index')}}">Gestión de roles</a>
        </li>
        <li>
            <a href="{{route('permisos.index')}}">Gestión de permisos</a>
        </li>
        <li>
            <a href="{{route('personas.index')}}">Gestión de personas</a>
        </li>
    </ul>
</section>
@endsection