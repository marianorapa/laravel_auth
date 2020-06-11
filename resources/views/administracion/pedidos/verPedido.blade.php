@extends('layouts.app')

@section('content')
    <section class="container">
        <section>
            <div class="bs-example">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('administracion.menu')}}">Administración</a></li>
                        <li class="breadcrumb-item active">Gestión de Pedidos</li>
                    </ol>
                </nav>
            </div>

        </section>


        <section>

            <div class="card">
               <div class="card-header text-center h3"></div>
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

                        </tbody>

                    </table>
                </div>
            </div>

        </section>
    </section>

@endsection
