@extends('layouts.app')
@section('publics')
    <script src="{{ asset('js/createFormulajs.js') }}"></script>
    <script
        src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.5/dist/latest/bootstrap-autocomplete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/notifCartel.js') }}"></script>
    <script src="{{ asset('js/errorCartel.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('administracion.menu')}}">Administración</a></li>
                    <li class="breadcrumb-item"><a href="{{route('administracion.stock')}}">Stock</a></li>
                    <li class="breadcrumb-item"><a href="{{route('administracion.stock.insumos')}}">Gestión de Stock de
                            Insumos</a></li>
                    <li class="breadcrumb-item active">Ajuste de stock</li>

                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div class="">
                    <p class="errorjs" style="display:none">{{ $errors->first() }}</p>
                </div>
            @endif

            <div class="card">
                <div class="card-header text-md-center h3">Ajuste de stock insumo</div>

                <div class="card-body">
                    @if (array_key_exists('idLoteInsumoEspecifico', $insumo))

                        <form action="{{route('administracion.stock.insumos.ajustarInsumoTrazable.post',
                                                [$insumo['idLoteInsumoEspecifico'],
                                                $insumo['idCliente']])}}" method="POST">
                            @else
                                <form action="{{route('administracion.stock.insumos.ajustarInsumoNoTrazable.post',
                                [$insumo['idInsumoNt'], $insumo['idCliente']])}}" method="POST">
                                    @endif
                                    @csrf
                                    <div class="form-inline">
                                        <label for="cliente" class="col-form-label col-2">Cliente</label>
                                        <input id="cliente" type="text" class="form-control col-9" name="cliente"
                                               value="{{$insumo['nombreCliente']}}" readonly>
                                    </div>

                                    <div class="form-inline mt-4">
                                        <label for="insumo" class="col-form-label col-2">Insumo</label>
                                        <input id="insumo" type="text" class="form-control col-6" name="insumo"
                                               value="{{$insumo['nombreInsumo']}}" readonly>

                                        <label for="lote" class="col-form-label col-1">Lote</label>
                                        <input id="lote" type="text" class="form-control col-2" name="lote"
                                               value="{{array_key_exists('nroLote', $insumo) ? $insumo['nroLote'] : "-"}}"
                                               readonly>
                                    </div>

                                    <div class="form-inline mt-4">
                                        <label for="stock" class="col-form-label col-2">Stock actual</label>
                                        <input id="stock" type="text" class="form-control col-2" name="stock"
                                               value="{{$insumo['stock']}}" readonly>
                                        <label class="ml-2">kgs</label>
                                    </div>

                                    <div class="form-inline mt-4">
                                        <label for="ajuste" class="col-form-label col-2">*Ajuste:</label>
                                        <input id="ajuste" type="number" class="form-control col-3" name="ajuste"
                                               placeholder="Ej. 5000 o -3500" required>
                                        <label class="ml-2">kgs</label>
                                    </div>

                                    <label class="text-info mt-3 ml-4">*Cantidad negativa para restar stock</label>

                                    <div class="form-inline mt-4">
                                        <label for="observacion" class="col-form-label col-2">Motivo:</label>
                                        <textarea id="observacion" type="" class="form-control col-6" name="observacion"
                                                  placeholder="Explique el motivo del ajuste..." minlength="10"
                                                  maxlength="255"
                                                  required ></textarea>
                                    </div>

                                    <div class="form-inline mt-5">
                                        <a class="btn btn-secondary col-2"
                                           content="{{old('motivo')}}"
                                           href="{{route('administracion.stock.insumos')}}">Cancelar</a>
                                        <button type="submit" class="btn btn-primary col-2 offset-8">Registrar</button>
                                    </div>

                                </form>


                </div>
            </div>
        </div>
    </div>

@endsection
