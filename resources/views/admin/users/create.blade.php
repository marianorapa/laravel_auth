@extends('layouts.app')

@section('content')

<section class="container">
    <div class="bs-example">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" >Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.menu')}}" >Admin</a></li>
                <li class="breadcrumb-item"><a href="{{route('users.index')}}" >Gestión de usuarios</a></li>
                <li class="breadcrumb-item active">Agregar usuario</li>
            </ol>
        </nav>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            @endif
            @if (session('mensaje'))
                <div class="alert alert-success" role="alert">
                    {{ session('mensaje') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning" role="alert">
                    {{ session('mensaje') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card">
                <div class="card-header h2">{{ __('Registro de usuarios') }}</div>
                    <div class="card-body">

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

                            <div class="form-group">
                                <label class="col-10">Seleccione a que persona corresponde este usuario:</label>
                                <input type="submit" name="refreshButton" value="Actualizar" class="btn btn-sm btn-outline-primary mb-2">

                                <select name="persona" id="persona" class="form-control">
                                    @foreach ($personas as $persona)
                                        <option value="{{$persona->id}}">{{"$persona->nombres $persona->apellidos"}}</option>
                                    @endforeach
                                </select>
                                <p class="mt-2 mb-3"><a class="" href="{{route('personas.create')}}" target="_blank">Nueva persona</a></p>
                            </div>

                            <div class="form-group">
                                <label for="username">Nombre de usuario</label>

                                <input type="text" name="username" id="username"
                                value="{{old('username')}}" placeholder="Nombre"
                                class="form-control mb-2" >

                            </div>


                            <div class="form-group">
                                <label for="password" >{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>La password debe tener 4 caracteres minimo y deben coincidir</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >

                        </div>

{{--Update 06-5 Marian. Email ya no esta en el usuario--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="email">Email</label>--}}
{{--                                <input type="text" name="email" id="email"--}}
{{--                                value="{{old('email')}}" placeholder="Email"--}}
{{--                                class="form-control mb-2" >--}}
{{--                            </div>--}}

                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <input type="text" name="descripcion" id="descripcion"
                                value="{{old('descripcion')}}"
                                placeholder="Descripcion" class="form-control mb-2" >
                            </div>
                            @error('descripcion')
                            <span class="invalid-feedback" role="alert">
                                        <strong>La descripcion es obligatoria.</strong>
                                    </span>
                            @enderror

{{--                            <p>Seleccione los roles del usuario:</p>--}}
{{--                            @foreach ($roles as $rol)--}}
{{--                                <div class="form-check">--}}
{{--                                    <input type="checkbox" class="form-check-input" name="{{$rol->name}}" id="{{$rol->name}}">--}}
{{--                                    <label for="{{$rol->name}}" class="form-check-label text-capitalize mb-3">{{$rol->name}}</label>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}



                            <script>

                                function toggleCheckboxes() {
                                    let list = document.getElementsByClassName("checkboxRol");
                                    let newValue = (document.getElementById("selectAllCheckbox")).checked;
                                    for (let item of list) {
                                        item.checked = newValue;
                                    }
                                }

                            </script>

                            <label class="col-md-10">Seleccione los roles del usuario:</label>


                            <div class="form-group row mx-5 ">

                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Rol</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col" class="text-center">
                                            Seleccionar
                                            <input type="checkbox" id="selectAllCheckbox" class="ml-1" onchange="toggleCheckboxes()">
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($roles as $rol)
                                        <tr>
                                            <td>{{$rol->id}}</td>
                                            <td>{{$rol->name}}</td>
                                            <td>{{$rol->descr}}</td>
                                            <td class="text-center">
                                                <input type="checkbox" name="{{$rol->name}}" class="checkboxRol" value="{{$rol->name}}">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>


{{--
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email"
                                value="{{old('email')}}" placeholder="Email"
                                class="form-control mb-2" required>
                            </div>
                            <p>Seleccione los roles del usuario:</p>
                            @foreach ($roles as $rol)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="{{$rol->name}}" id="{{$rol->name}}">
                                    <label for="{{$rol->name}}" class="form-check-label text-capitalize mb-3">{{$rol->name}}</label>
                                </div>
                            @endforeach --}}

                            <input type="submit" name="registrar" value="Registrar usuario" class="btn btn-primary btn-block mt-5">
                            <a class="btn btn-secondary btn-block mt-4" href="{{route('users.index')}}">Volver</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>

</section>

@endsection
