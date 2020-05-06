@extends('layouts.app')

@section('content')

<section class="container">
    <div class="bs-example">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" >Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.menu')}}" >Admin</a></li>
                <li class="breadcrumb-item"><a href="{{route('users.index')}}" >Gestion de usuarios</a></li>
                <li class="breadcrumb-item active">Editar usuario</li>
            </ol>
        </nav>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar usuario
                </div>
                <div class="card-body">
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
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{session('error')}}
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
                            value="{{$user->descripcion}}"
                            placeholder="Descripcion" class="form-control mb-2" required>
                         </div>

{{--                        <div class="form-group">--}}
{{--                            <label for="email">Email</label>--}}
{{--                            <input type="text" name="email" id="email"--}}
{{--                            value="{{$user->email}}" placeholder="Email"--}}
{{--                            class="form-control mb-2" required>--}}
{{--                        </div>--}}


                        {{-- @foreach ($roles as $rol)
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="{{$rol->name}}" id="{{$rol->name}}">
                                <label for="{{$rol->name}}" class="form-check-label text-capitalize mb-3">{{$rol->name}}</label>
                            </div>
                        @endforeach --}}

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
                                @foreach ($roles as $rol)
                                    <tr>
                                        <td>{{$rol->id}}</td>
                                        <td>{{$rol->nombre}}</td>
                                        <td>{{$rol->descr}}</td>
                                        <td class="text-center">
                                            @if ($user->hasRole($rol->name))
                                                <input type="checkbox" name="roles[]" class="checkboxRol" value="{{$rol->name}}" checked>
                                            @else
                                                <input type="checkbox" name="roles[]" class="checkboxRol" value="{{$rol->name}}">
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>



{{--                        <div class="form-group">--}}
{{--                            <label for="roles">Roles: Seleccione los que correspondan (tecla shift)</label>--}}
{{--                            <select name="roles[]" id="roles" class="form-control" multiple>--}}
{{--                                @foreach ($roles as $rol)--}}
{{--                                    @if ($user->hasRole($rol->name))--}}
{{--                                        <option value="{{$rol->name}}" selected>{{$rol->name}}</option>--}}
{{--                                    @else--}}
{{--                                        <option value="{{$rol->name}}">{{$rol->name}}</option>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

                        <input type="submit" value="Actualizar usuario" class="btn btn-primary btn-block mt-3">
                        <a class="btn btn-secondary btn-block mt-4" href="{{route('users.index')}}">Volver</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </section>


@endsection
