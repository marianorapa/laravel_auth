@extends('layouts.app')
@section('publics')
    <script src="{{ asset('js/rolescreate.js') }}"></script>
@endsection
@section('content')

<section class="container">
    <div class="bs-example">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" >Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.menu')}}" >Admin</a></li>
                <li class="breadcrumb-item"><a href="{{route('roles.index')}}" >Gestion de roles</a></li>
                <li class="breadcrumb-item active">Editar rol</li>
            </ol>
        </nav>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center h2">
                    Editar rol
                </div>
                <div class="card-body">
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
                    <form action="{{route('roles.update', $rol->id)}}" method="POST">
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

                        <div class="form-group">
                            <label for="username">Nombre</label>

                            <input type="text" name="name" id="name"
                            value="{{$rol->name}}" placeholder="Nombre"
                            class="usernamejs form-control mb-2" required>
                        </div>


                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" name="descripcion" id="descripcion"
                            value="{{$rol->descr}}"
                            placeholder="Descripcion"  class="observacionjs form-control mb-2" required>
                         </div>


{{--                        <p>Seleccione los permisos de los roles:</p>--}}
                            {{-- @foreach ($permisos as $permiso)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="{{$permiso->name}}" id="{{$permiso->name}}">
                                    <label for="{{$permiso->name}}" class="form-check-label text-capitalize mb-3">{{$permiso->name}}</label>
                                </div>
                             @endforeach   --}}

{{--                             <select name="permisos[]" id="permisos" class="form-control" size="15" required multiple>--}}
{{--                                @foreach ($permisos as $permiso)--}}
{{--                                    @if ($rol->hasPermiso($permiso->nombre_ruta))--}}
{{--                                         <option value="{{$permiso->id}}" selected>{{"$permiso->descr : '$permiso->nombre_ruta'  "}}</option>--}}
{{--                                    @else--}}
{{--                                         <option value="{{$permiso->id}}">{{"$permiso->descr : '$permiso->nombre_ruta'  "}}</option>--}}
{{--                                     @endif--}}
{{--                                @endforeach--}}
{{--                            </select>--}}

                        <script>

                            function toggleCheckboxes() {
                                let list = document.getElementsByClassName("checkboxPermiso");
                                let newValue = (document.getElementById("selectAllCheckbox")).checked;
                                for (let item of list) {
                                    item.checked = newValue;
                                }
                            }

                        </script>

                        <label class="col-md-10">Seleccione los permisos del rol:</label>
                        <input type="checkbox" id="selectAllCheckbox" onchange="toggleCheckboxes()">

                        <div class="form-group row mx-5 ">

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Permiso</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Seleccionar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($permisos as $permiso)
                                    <tr>
                                        <td>{{$permiso->id}}</td>
                                        <td>{{$permiso->nombre_ruta}}</td>
                                        <td>{{$permiso->descr}}</td>
                                        <td class="text-center">
                                            @if ($rol->hasPermiso($permiso->nombre_ruta))
                                                <input type="checkbox" name="permisos[]" class="checkboxPermiso" value="{{$permiso->id}}" checked>
                                            @else
                                                <input type="checkbox" name="permisos[]" class="checkboxPermiso" value="{{$permiso->id}}">
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                            <input type="submit" value="Actualizar rol" class="btn btn-primary btn-block mt-3">
                            <a class="btn btn-secondary btn-block mt-4" href="{{route('roles.index')}}">Volver</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
