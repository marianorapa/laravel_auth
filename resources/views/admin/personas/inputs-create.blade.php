@inject('Provincia', 'App\Provincia')

<div class="form-group row">
    <label for="nombresPersona" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>

    <div class="col-md-6">
        <input id="nombresPersona" type="text" class="form-control" name="nombresPersona" required>
    </div>
</div>


<div class="form-group row">
    <label for="apellidos" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

    <div class="col-md-6">
        <input id="apellidos" type="text" class="form-control" name="apellidos" required>
    </div>
</div>


<div class="form-group row">
    <label for="fechaNac" class="col-md-4 col-form-label text-md-right">{{ __('Fecha nacimiento') }}</label>

    <div class="col-md-6">
        <input id="fechaNac" type="date" class="form-control" name="fechaNac" required>
    </div>
</div>

@include('comun.personas_tipo.inputs-create')

@include('comun.domicilios.inputs-create')
