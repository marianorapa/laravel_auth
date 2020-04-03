@extends('layouts.app')

@section('content')
    
<section class="container">
        <form action="{{route('users.update', $user->id)}}" method="POST">
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
                <label for="username">Nombre</label>          
    
                <input type="text" name="username" id="username" 
                value="{{$user->username}}" placeholder="Nombre" 
                class="form-control mb-2" required>
            </div>
            
            
            <div class="form-group">
                <label for="password" >{{ __('Password') }}</label>
    
                <input id="password" type="password" placeholder="(sin cambios)" 
                    class="form-control @error('password') is-invalid @enderror" name="password">
    
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
               
         </div>
    
            <div class="form-group">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm"  type="password" class="form-control" name="password_confirmation">
                
            </div>
    
    
            <div class="form-group">
                <label for="descripcion">Descripción</label>           
                <input type="text" name="descripcion" id="descripcion"
                value="{{$user->descr}}"
                placeholder="Descripcion" value={{$user->password}} class="form-control mb-2" required>
             </div>
    
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" 
                value="{{$user->email}}" placeholder="Email" 
                class="form-control mb-2" required>
            </div>
                   
            @foreach ($roles as $rol)
            <div class="form-check">            
               <input type="checkbox" checked="{{$user->hasRole($rol->name)}}" class="form-check-input" name="{{$rol->name}}" id="{{$rol->name}}">
               <label for="{{$rol->name}}" class="form-check-label text-capitalize mb-3">{{$rol->name}}</label>
           </div>    
         @endforeach  

            <input type="submit" value="Actualizar usuario" class="btn btn-primary btn-block mt-3">
        </form>
    </section>


@endsection