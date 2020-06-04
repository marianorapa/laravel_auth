@extends('layouts.app')

@section('content')
    <section class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" >Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('administracion.menu')}}" >Administración</a></li>
                    <li class="breadcrumb-item"><a href="{{route('formula.index')}}" >Gestion de Formulas</a></li>
                    <li class="breadcrumb-item active">Detalle de Formula</li>
                </ol>
            </nav>
        </div>
        <section>

            <div class="card">
                <div class="card-header text-center h3 ">{{$nombreAlimento->descripcion}}</div>
                <div class="card-body">
                    <table class="table">

                        <thead>
                            <tr>
                                <th scope="col">id insumo</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">kilos por tonelada</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($formula as $formula)
                                <tr>
                                    <th scope="row">{{$formula->insumo_id}}</th>
                                    <td>{{$formula->descripcion}}</td>
                                    <td>{{$formula->kilos_por_tonelada}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row justify-content-center">

                    </div>
                </div>
            </div>
        </section>

    </section>
@endsection
