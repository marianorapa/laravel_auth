@extends('layouts.app')

@section('content')
<section class="container">
    <div class="list-group">
        <a href="{{route('users.index')}}" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">Gestión de usuarios</h5>                
            </div>
            <p class="mb-1">Menu de altas, bajas y modificación de usuarios.</p>            
        </a>        
        
        
        <a href="{{route('roles.index')}}" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">Gestión de roles</h5>                
            </div>
            <p class="mb-1">Menu de altas, bajas y modificación de roles.</p>            
        </a>        
        
        
        <a href="{{route('permisos.index')}}" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">Gestión de permisos</h5>                
            </div>
            <p class="mb-1">Menu de altas, bajas y modificación de permisos.</p>            
        </a>
        
        
        
        <a href="{{route('personas.index')}}" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">Gestión de personas</h5>                
            </div>
            <p class="mb-1">Menu de altas, bajas y modificación de personas.</p>            
        </a>

    </div>
</section>
@endsection