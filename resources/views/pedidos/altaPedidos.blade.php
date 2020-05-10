@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" >Home</a></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div    class="card">
                <div class="card-header text-center h2"> {{__('Alta de pedido de cliente') }}</div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-inline row">
                            <label for="cliente" class="col-md-1 col-form-label text-md-left">Cliente</label>

                            <select name="cliente" id="cliente"  class="custom-select col-md-2">
                                <option data-tokens=="0">Seleccione</option>

                               {{--@foreach ($Cliente->getcliente() as $index => $cli )

                                    <option data-tokens="{{$cli}}"> {{$cli}}</option>
                                @endforeach--}}
                                <option data-tokens="julia"> julia</option>
                                <option data-tokens="adasd"> asdasdsa</option>
                                <option data-tokens="qweqeq"> qweqweqe</option>
                                <option data-tokens="pedro"> pedro</option>
                                <option data-tokens="fernando">fernando</option>
                            </select>
                            <label for="producto" class="col-lg-1 col-form-label text-md-right offset-md-1">Producto</label>

                            <select name="producto" id="producto" class="custom-select col-md-2" >

                            </select>

                            <label for="cantidad" class="col-lg-1 col-form-label text-md-right offset-md-1">Cantidad</label>

                            <input id="cantidad" type="text" class="form-control col-md-2" placeholder="KG" name="cantidad" required>

                        </div>

                        <div class="form-group row">
                            <label for="insumosnecesarios" class="h2 col-md-3 text-md-left mt-5">Insumos Necesarios</label>

                            <table class="table mt-2">
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
                                        <div class="alert alert-success">
                                            {{session('mensaje')}}
                                        </div>
                                    @endif
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Insumo</th>
                                            <th scope="col">Cantidad necesaria</th>
                                            <th scope="col">Cantidad pendiente</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                        </tr>
                                    </tbody>
                                </table>


                        </div>

                        <div class="form-group row">
                            <label for="insumosdispcli" class="h2 col-md-4 text-md-left mt-5">Insumos disponible del cliente</label>

                            <table class="table mt-2">
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
                                    <div class="alert alert-success">
                                        {{session('mensaje')}}
                                    </div>
                                @endif
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Insumo</th>
                                    <th scope="col">lote</th>
                                    <th scope="col">Cantidad stock</th>
                                    <th scope="col">Cantidad a utilizar</th>
                                </tr>

                                </thead>
                                <tbody>
                                <tr>
                                    <th></th>
                                </tr>
                                </tbody>
                            </table>

                            <button type="submit" class="btn btn-outline-success btn-block col-sm-2 offset-10 mt-3">
                                Verificar
                            </button>
                        </div>

                        <div class="form-group row">
                            <label for="insumosdispfab" class="h2 col-md-4 text-md-left mt-5">Insumos disponible de fabrica</label>

                            <table class="table mt-2">
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
                                    <div class="alert alert-success">
                                        {{session('mensaje')}}
                                    </div>
                                @endif
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Insumo</th>
                                    <th scope="col">lote</th>
                                    <th scope="col">Cantidad stock</th>
                                    <th scope="col">Cantidad a utilizar</th>

                                </tr>

                                </thead>
                                <tbody>
                                <tr>
                                    <th></th>
                                </tr>
                                </tbody>
                            </table>


                        </div>

                        <div class="form-group row mt-5">
                            <label for="fechaentrega" class="col-md-2 col-form-label text-md-right">Fecha de entrega</label>
                            <input id="fechaentrega" type="date" class="form-control col-md-2"  name="fechaentrega" required>

                            <label for="precioxkg" class="col-md-2 col-form-label text-md-right">precio por kg</label>
                            <input id="precioxkg" type="text" class="form-control col-md-2"  name="precioxkg" >


                        </div>

                        <div class="form-inline row mt-5">
                            <button class="btn btn-secondary col-sm-3">Cancelar</button>
                            <button class="btn btn-primary col-sm-3 offset-md-6">Registrar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>


    </div>

@endsection
