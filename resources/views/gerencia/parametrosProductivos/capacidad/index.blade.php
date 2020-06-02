@extends('layouts.app')

{{-- Lo comento pq no se si aca funcionaria tambien. --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
   <script src="{{ asset('js/sweetAlert2.js') }}"></script>
    <script src="{{ asset('js/notifCartel.js') }}"></script>
   <script src="{{ asset('js/errorCartel.js') }}"></script>


@section('content')
<section class="container">
    <section>
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" >Home</a></li>
                    <li class="breadcrumb-item"><a href="/gestionParametrosProductivos" >Parámetros</a></li>
                    <li class="breadcrumb-item active">Gestion de capacidad productiva</li>
                </ol>
            </nav>
        </div>

        <a class="btn btn-primary btn-sm m-1" href="{{route('parametros.capacidad.view')}}">Agregar</a>

        <nav class="float-right">
            <form class="form-inline">
                <input name='name' class="form-control mr-sm-2" type="search" placeholder="Nombre" aria-label="buscar por nombre">
                <input name='descr' class="form-control mr-sm-2" type="search" placeholder="Descr" aria-label="buscar por descripcion">
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

                @if (session('message'))
                    <div class="">
                       <p class="alertajs" style="display:none"> {{ session('message') }} </p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="">
                       <p class="errorjs" style="display:none"> {{ session('error') }} </p>
                    </div>
                @endif
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Desde</th>
                    <th scope="col">Hasta</th>
                    <th scope="col">Capacidad</th>
                    <th scope="col">Prioridad</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($capacidadHistorico as $capacidad)
                        <tr>
                            <th scope="row">{{$capacidad->id}}</th>
                            <td>{{$capacidad->fecha_desde}}</td>
                            <td>{{$capacidad->fecha_hasta == null ? '-' : $capacidad->fecha_hasta}}</td>
                            <td>{{$capacidad->capacidad}}</td>
                            <td>{{$capacidad->prioridad_id}}</td>
                        </tr>
                    @endforeach
                    </tbody>
              </table>
            <div class="row justify-content-center">
{{--                {{$permisos->links()}}--}}
            </div>
    </section>
      <a class="btn btn-secondary btn-sm" href="{{route('parametros.index')}}">Volver</a>

    </section>
@endsection
