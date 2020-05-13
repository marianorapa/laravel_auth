@section('publics')
    <script src="{{ asset('js/inputscreate.js') }}"></script>
    <script src="{{ asset('js/inputscreatePT.js') }}"></script>
    <script src="{{ asset('js/inputscreateDom.js') }}"></script>
@endsection

<div class="form-group row">
    <label for="nombres" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>

    <div class="col-md-6">
         <input id="nombres" type="text" class="nombrepjs form-control" name="nombres" value="{{old('nombres')}}" required>
        @error('nombres')
        <span class="invalid-feedback" role="alert">
            <strong>Nombre invalido</strong>
        </span>
        @enderror
    </div>


</div>


<div class="form-group row">
    <label for="apellidos" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

    <div class="col-md-6">
        <input id="apellidos" type="text" class="apellidosjs form-control" name="apellidos" value="{{old('apellidos')}}" required>
        @error('apellidos')
        <span class="invalid-feedback" role="alert">
            <strong>Apellidos invalidos</strong>
        </span>
        @enderror
    </div>
</div>


<div class="form-group row">
    <label for="fecha_nacimiento" class="col-md-4 col-form-label text-md-right">{{ __('Fecha nacimiento') }}</label>

    <div class="col-md-6">
        <input id="fecha_nacimiento" type="date" class="fechaNacjs form-control" name="fecha_nacimiento" value="{{old('fecha_nacimiento')}}" required>
        @error('apellidos')
        <span class="invalid-feedback" role="alert">
            <strong>Fecha invalida</strong>
        </span>
        @enderror
    </div>
</div>

@include('comun.personas_tipo.inputs-create')

@include('comun.domicilios.inputs-create')
