@extends('layouts.app')

@section('content')
      
<section class="container">
    <form action="{{route('users.store')}}" method="POST">
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

            <input type="text" name="name" id="name" 
            value="{{old('username')}}" placeholder="Nombre" 
            class="form-control mb-2" required>
                
        </div>
        

        <div class="form-group">
            <label for="descripcion">Descripción</label>           
            <input type="text" name="descr" id="descr"
            value="{{old('descripcion')}}"
            placeholder="Descripcion" class="form-control mb-2" required>
         </div>
       

        <input type="submit" value="Registrar Rol" class="btn btn-primary btn-block mt-3">
    </form>
</section>  
@endsection