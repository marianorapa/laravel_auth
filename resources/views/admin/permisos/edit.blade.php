@extends('layouts.app')

@section('content')
    <section class="container">
            <form action="{{route('permisos.update', $permiso->id)}}" method="POST">
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
                    <label for="name">Nombre</label>          
        
                    <input type="text" name="name" id="name" 
                    value="{{$permiso->name}}" placeholder="Nombre" 
                    class="form-control mb-2" required>
                </div>
                
        
                <div class="form-group">
                    <label for="descr">Descripción</label>           
                    <input type="text" name="descr" id="descr"
                    value="{{$permiso->descr}}"
                    placeholder="Descripcion" value={{$permiso->descr}} class="form-control mb-2" required>
                </div>
        
                <div class="form-group">
                    <label for="funcionalidad">Email</label>
                    <input type="text" name="funcionalidad" id="funcionalidad" 
                    value="{{$permiso->funcionalidad}}" placeholder="Acciones" 
                    class="form-control mb-2" required>
                </div>
                    

                <input type="submit" value="Actualizar permiso" class="btn btn-primary btn-block mt-3">
            </form>
        </section>


@endsection