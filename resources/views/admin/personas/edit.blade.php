@extends('layouts.app')

@section('content')
    
<section class="container">
        <form action="{{route('personas.update', $persona->id)}}" method="POST">
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
                <label for="nombrePersona">Nombre</label>          
    
                <input type="text" name="nombresPersona" id="nombresPersona" 
                value="{{$persona->nombres}}" placeholder="Nombre" 
                class="form-control mb-2" required>
            </div>

            <div class="form-group">
                <label for="apellidos">Apellidos</label>          
    
                <input type="text" name="apellidos" id="apellidos" 
                value="{{$persona->apellidos}}" placeholder="Apellidos" 
                class="form-control mb-2" required>
            </div>
              
    
            <div class="form-group">
                <label for="descr">Descripción</label>           
                <input type="text" name="descr" id="descr"
                value="{{$persona->descripcion}}"
                placeholder="Descripcion" class="form-control mb-2" required>
            </div>
            <div class="form-group">
                <label for="fechaNac">Fecha de nacimiento</label>           
                <input type="date" name="fechaNac" id="fechaNac"
                value="{{$persona->fechaNacimiento}}"
                placeholder="" value={{$persona->fechaNacimiento}} class="form-control mb-2" required>
            </div>
            <div class="form-group">
                <label for="direccion">Direccion</label>           
                <input type="text" name="direccion" id="direccion"
                value="{{$persona->domicilio}}"
                placeholder="Direccion" value={{$persona->domicilio}} class="form-control mb-2" required>
            </div>
            <div class="form-group">
                <label for="tel">Telefono</label>           
                <input type="text" name="tel" id="tel"
                value="{{$persona->telefono}}"
                placeholder="tel" value={{$persona->telefono}} class="form-control mb-2" required>
            </div>

            <div class="form-group">
                <label for="tipoDoc">Tipo Documento</label>           
                <div class="col-md-6">
                    <select name="tipoDoc" id="tipoDoc" class="form-control">
                        <option value="DNI">DNI</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="nroDocumento">Nro Documento</label>           
                <input type="text" name="nroDocumento" id="nroDocumento"
                value="{{$persona->nroDocumento}}"
                placeholder="nroDocumento" value={{$persona->nroDocumento}} class="form-control mb-2" required>
            </div>
                   

            <input type="submit" value="Actualizar persona" class="btn btn-primary btn-block mt-3">
            <a class="btn btn-secondary btn-block mt-4" href="{{route('personas.index')}}">Volver</a>
        </form>
    </section>


@endsection