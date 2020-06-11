@extends('layouts.app')

{{-- Lo comento pq no se si aca funcionaria tambien. --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{ asset('js/sweetAlert2.js') }}"></script>
<script src="{{ asset('js/notifCartel.js') }}"></script>
<script src="{{ asset('js/errorCartel.js') }}"></script>
<script src="{{ asset('js/validarFiltros.js') }}"></script>


@section('content')
    <section class="container">
        <section>
            <div class="bs-example">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('gerencia.index')}}">Gerencia</a></li>
                        <li class="breadcrumb-item"><a href="/gestionParametrosProductivos">Parámetros</a></li>
                        <li class="breadcrumb-item active">Gestión de precios</li>
                    </ol>
                </nav>
            </div>

            <a class="btn btn-primary btn-sm m-1" href="{{route('parametros.precio.view')}}">Agregar</a>


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

                @if (session('mensaje'))
                    <div class="">
                        <p class="alertajs" style="display:none"> {{ session('mensaje') }} </p>
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
                    <th scope="col">Precio ref.</th>
                    <th scope="col">% Variación adm.</th>
                    <th scope="col">Desde</th>
                    <th scope="col">Hasta</th>
                    <th scope="col">Prioridad</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($precios as $precio)
                    <tr>
                        <th scope="row">{{$precio->id}}</th>
                        <td>{{$precio->precio}}</td>
                        <td>{{$precio->variacion * 100}}%</td>
                        <td>{{$precio->fecha_desde}}</td>
                        <td>{{$precio->fecha_hasta ? $precio->fecha_hasta : "-"}}</td>
                        <td>{{$precio->prioridad}}</td>
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
