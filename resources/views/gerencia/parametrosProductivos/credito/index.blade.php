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
                    <li class="breadcrumb-item"><a href="{{route('parametros.index')}}" >Parámetros</a></li>
                    <li class="breadcrumb-item active">Gestion de crédito</li>
                </ol>
            </nav>
        </div>


        <nav class="float-right">
            <form class="form-inline">
                <input name="cliente" class="form-control mr-sm-2" type="search" placeholder="Cliente..." aria-label="buscar por cliente">
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
                    <th scope="col">Cliente</th>
                      <th scope="col">Crédito</th>
                    <th scope="col">Desde</th>
                    <th scope="col">Hasta</th>
                      <th scope="col">Acción</th>

                  </tr>
                </thead>
                <tbody>
                    @foreach ($creditos as $credito)
                        <tr>
                            <th scope="row">{{$credito->id}}</th>
                            <td>{{$credito->cliente}}</td>
                            <td>{{$credito->limite}}</td>
                            <td>{{$credito->fecha_desde}}</td>
                            <td>{{$credito->fecha_hasta == null ? '-' : $credito->fecha_hasta}}</td>
                            <td><a class="btn btn-success btn-sm" href="{{route('parametros.credito.edit', $credito->id)}}">Nueva</a></td>
                        </tr>
                    @endforeach
                    </tbody>
              </table>
            <div class="row justify-content-center">
            </div>
    </section>
      <a class="btn btn-secondary btn-sm" href="{{route('parametros.index')}}">Volver</a>

    </section>
@endsection
