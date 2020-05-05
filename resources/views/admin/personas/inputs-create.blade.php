<div class="form-group row">
    <label for="nombres" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>

    <div class="col-md-6">
         <input id="nombres" type="text" class="form-control" name="nombres" value="{{old('nombres')}}" required>
    </div>
</div>


<div class="form-group row">
    <label for="apellidos" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

    <div class="col-md-6">
        <input id="apellidos" type="text" class="form-control" name="apellidos" value="{{old('apellidos')}}" required>
    </div>
</div>


<div class="form-group row">
    <label for="fecha_nacimiento" class="col-md-4 col-form-label text-md-right">{{ __('Fecha nacimiento') }}</label>

    <div class="col-md-6">
        <input id="fecha_nacimiento" type="date" class="form-control" name="fecha_nacimiento" value="{{old('fecha_nacimiento')}}" required>
    </div>
</div>

@include('comun.personas_tipo.inputs-create')

@include('comun.domicilios.inputs-create')
