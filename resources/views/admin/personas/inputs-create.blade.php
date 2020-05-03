
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

<div class="form-group row">
    <label for="tipoDoc" class="col-md-4 col-form-label text-md-right">Tipo Documento</label>
    <div class="col-md-6">
        <select name="tipoDoc" id="tipoDoc" class="form-control">
            <option value="DNI">DNI</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="nroDocumento" class="col-md-4 col-form-label text-md-right">{{ __('Nro Documento') }}</label>

    <div class="col-md-6">
        <input id="nroDocumento" type="text" class="form-control" name="nroDocumento" required>
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

    <div class="col-md-6">
        <input id="email" type="tel" class="form-control" name="email" required>
    </div>
</div>

<div class="form-group row">
    <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

    <div class="col-md-6">
        <input id="tel" type="tel" class="form-control" name="tel" required>
    </div>
</div>

<div class="form-group row">
    <label for="calle" class="col-md-4 col-form-label text-md-right">{{ __('Calle') }}</label>

    <div class="col-md-6">
        <input id="calle" type="text" class="form-control" name="calle" required>
    </div>

    <label for="numero" class="col-md-4 col-form-label text-md-right">{{ __('Numero') }}</label>

    <div class="col-md-6">
        <input id="numero" type="text" class="form-control" name="numero" required>
    </div>

    <label for="piso" class="col-md-4 col-form-label text-md-right">{{ __('Piso') }}</label>

    <div class="col-md-6">
        <input id="piso" type="text" class="form-control" name="piso" required>
    </div>

    <label for="dpto" class="col-md-4 col-form-label text-md-right">{{ __('Dpto') }}</label>

    <div class="col-md-6">
        <input id="dpto" type="text" class="form-control" name="dpto" required>
    </div>
</div>

<div class="form-group row">
    <label for="observaciones" class="col-md-4 col-form-label text-md-right">{{ __('Observaciones:') }}</label>

    <div class="col-md-6">
        <input id="observaciones" type="text" class="form-control" name="observaciones">
    </div>
</div>

