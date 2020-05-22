@extends('layouts.app')


@section('publics')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/sweetAlert2.js') }}"></script>
    <script src="{{ asset('js/notifCartel.js') }}"></script>
@endsection

@section('content')



<section class="container">
    <section>
    <div class="bs-example">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" >Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.menu')}}" >Admin</a></li>
                <li class="breadcrumb-item active">Gestion de personas</li>
            </ol>
        </nav>
    </div>

        <a class="btn btn-primary btn-sm m-1" href="{{route('personas.create')}}">Agregar</a>

        <nav class="navbar navbar-light float-right mb-2">
            <form class="form-inline">
                <input name='name' class="form-control mr-sm-2" type="search" placeholder="Nombre" aria-label="buscar por nombre">
                <input name='apellido' class="form-control mr-sm-2" type="search" placeholder="Apellido" aria-label="buscar por apellido">
                <input name='nrodocumento' class="form-control mr-sm-2" type="search" placeholder="NroDoc" aria-label="buscar por dni">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>
        </nav>
    </section>

    <section class="mt-3">
        <table class="table">
              
        @if ($errors->any())
              <div class="alert alert-danger">
                 {{$errors->first()}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                     {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
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
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Fecha Nac</th>
                <th scope="col">Domicilio</th>
                <th scope="col">Telefono</th>
                <th scope="col">Nro Doc</th>
                <th scope="col">Tipo Doc</th>
                <th scope="col">Activo</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($personas as $persona)
                    <tr>
                        <th scope="row">{{$persona->id}}</th>
                        <td>{{$persona->nombres}}</td>
                        <td>{{$persona->apellidos}}</td>
                        <td>{{$persona->personaTipo()->first()->observaciones}}</td>
                        <td>{{$persona->fecha_nacimiento}}</td>
                        <td>{{$persona->personaTipo()->first()->domicilio()->first()->toString()}}</td>
                        <td>{{$persona->personaTipo()->first()->telefono}}</td>
                        <td>{{$persona->personaTipo()->first()->nro_documento}}</td>
                        <td>{{$persona->personaTipo()->first()->tipoDocumento()->first()->descripcion}}</td>
                        <td>{{$persona->trashed() ? "No": "Si"}}</td>
                        <td>
                            <a href="{{route('personas.edit', $persona)}}" class="btn btn-warning btn-sm">Editar</a>
                            @if (!$persona->trashed())
                            
                            <form method="post" id="destroy-appointment-{{ $persona }}" action="{{route('personas.destroy', $persona)}}" onSubmit="return confirm('Desea eliminar?');">
                                    <input type="hidden" name="id" value={{ $persona }}>
                                    @method('DELETE')
                                    @csrf
                                    <button class ="btn btn-danger btn-sm" type="submit" form="destroy-appointment-{{ $persona }}">Eliminar</button>
                                </form>
                         
                            @else
                                <a class="btn btn-success btn-sm" href="{{route('personas.activate',$persona->id)}}">Activar</a>
                            @endif



                                <!--<form action="{{route('personas.destroy', $persona)}}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-sm eliminarjs">Eliminar</button>
                                  </form>-->

                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </section>
      <a class="btn btn-secondary btn-sm" href="{{route('admin.menu')}}">Volver</a>
    </section>



@endsection
