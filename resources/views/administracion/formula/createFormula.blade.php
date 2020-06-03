@extends('layouts.app')
@section('publics')
    <script src="{{ asset('js/createFormulajs.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.5/dist/latest/bootstrap-autocomplete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/notifCartel.js') }}"></script>
    <script src="{{ asset('js/errorCartel.js') }}"></script>
@endsection

@section('content')
    {{--@inject('Cliente', 'App\Cliente')--}}{{--POR AHORA--}}
    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" >Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('formula.index')}}" >Gestión de Formula</a></li>

                    <li class="breadcrumb-item active">Nueva formula</li>

                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card">
                <div class="card-header text-md-center h2"> Registro de nueva formula</div>
                <div class="card-body">
                    <form action="{{route('formula.store')}}" method="POST">
                        @csrf
                        <div class="form-inline row">
                            {{--cliente--}}
                            <label for="cliente" class="col-md-1 col-form-label text-md-left">Cliente</label>
                            <select name="cliente" id="cliente"  class="cliente_id custom-select col-md-2 form-check-input:invalid"> {{--checkear que form-check-input:invalid ande--}}
                                <option data-tokens=="0">Seleccione</option>

                                @foreach ($clientes as $cliente){{--esto lo hago por ahora, despues recibiria cliente desde el controller--}}
                                    <option value="{{$cliente->id}}"> {{$cliente->empresa()->first()->denominacion}}</option>
                                @endforeach
                            </select>

                            {{--producto--}}
                            <label for="producto" class="col-md-1 col-form-label text-md-right offset-md-1">Producto</label>
                            <select name="producto" id="producto" class="productos custom-select col-md-2" >

                            </select>

                            {{--insumo--}}
                            <label for="insumo" class="col-md-1 col-form-label text-md-right offset-md-1">Insumo</label> {{--solo traigo insumos no trazables--}}
                            <select name="insumo" id="insumo" class="insumo custom-select col-md-2" >
                                <option value="">seleccione</option>
                            </select>
                            {{--<input type="text" class="form-control basicAutoComplete"  placeholder="type to search..." autocomplete="off"> PROBAR LUEGO--}}

                        </div>

                        <div class="form-group row d-flex justify-content-center">
                            <label for="tablainsumos" class="h2 text-md-center mt-5 col-md-10">Insumos</label>

                            <table class="table mt-2 col-md-10 tablageneral">
                                <thead>
                                    <tr>
                                        <th scope="col">Id insumo</th>
                                        <th scope="col">Nombre Insumo</th>
                                        <th scope="col">Proporción (kg. por tn)</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyinsumos">
                                </tbody>

                            </table>

                        </div>

                       <div class="form-inline row">
                           <label for="fechadesde" class="col-md-2 col-form-label text-md-right">Fecha desde</label>
                           <input id="fechadesde" type="date" class="fechadesde form-control" name="fechadesde" value="{{old('fechadesde')}}" required>

                           <label for="fechahasta" class="col-md-2 col-form-label text-md-right offset-md-1">Fecha hasta</label>
                           <input id="fechahasta" type="date" class="fechahasta form-control" name="fechahasta" value="{{old('fechahasta')}}" >
                       </div>

                        <div class="form-inline row mt-5">
                            <button class="btn btn-secondary col-sm-3">Cancelar</button>
                            <button  type="submit" class="btn btn-primary col-sm-3 offset-md-6" >Registrar</button>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    {{--<script>
        $('.basicAutoComplete').autoComplete({
            resolverSettings: {
                url: '{{route('productos')}}'
            }
        });

    </script>--}}
@endsection
