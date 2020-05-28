@extends('layouts.app')
@section('publics')
    <script src="{{ asset('js/createFormulajs.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.5/dist/latest/bootstrap-autocomplete.min.js"></script>
@endsection

@section('content')
    @inject('Cliente', 'App\Cliente'){{--POR AHORA--}}
    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">

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
                <div class="card-header text-md-center h2"></div>
                <div class="card-body">
                    <form action="" method="">
                        <div class="form-inline row">
                            {{--cliente--}}
                            <label for="cliente" class="col-md-1 col-form-label text-md-left">Cliente</label>
                            <select name="cliente" id="cliente"  class="cliente_id custom-select col-md-2 form-check-input:invalid"> {{--checkear que form-check-input:invalid ande--}}
                                <option data-tokens=="0">Seleccione</option>

                                @foreach (\App\Cliente::all() as $cliente){{--esto lo hago por ahora, despues recibiria cliente desde el controller--}}
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

                            <table class="table mt-2 col-md-10">
                                <thead>
                                    <tr>
                                        <th scope="col">Id insumo</th>
                                        <th scope="col">Nombre Insumo</th>
                                        <th scope="col">Proporcion</th>
                                        <th scope="col">Accion</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyinsumos">
                                    <tr>
                                        <th></th>
                                    </tr>
                                </tbody>

                            </table>

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
