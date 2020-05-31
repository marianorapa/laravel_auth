@extends('layouts.app')
@section('content')
    <section class="container">
        <section>
            <div class="bs-example">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" >Home</a></li>

                    </ol>
                </nav>
            </div>

            <div class="row justify-content-center mt-4">
                <a class="btn btn-primary btn m-1 col-3" href="{{route('formulaCreate')}}">Nueva Formula</a>
            </div>
            <div class="row justify-content-center mt-4 border-top border-bottom py-3">
                <form class="form-inline">
                    <input name="cliente" class="form-control mr-sm-2" type="search" placeholder="Cliente" aria-label="buscar por Cliente">
                    <input name="alimento" class="form-control mr-sm-2" type="search" placeholder="Alimento" aria-label="buscar por Alimento">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
            </div>
        </section>


        <section>
            <table class="table mt-5">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{$errors->first()}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Alimento</th>
                        <th scope="col">fecha desde</th>
                        <th scope="col">fecha hasta</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>

                <tbody>
                @foreach($formulas as $formula)
                    <tr>
                        <th scope="row">{{$formula->id}}</th>
                        <td>{{--{{$formula->alimento()->first()->descripcion}}--}}</td>
                        <td>{{$formula->fecha_desde}}</td>
                        <td>{{$formula->fecha_hasta}}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </section>
    </section>
@endsection