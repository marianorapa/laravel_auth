@inject('TipoDocumento', 'App\TipoDocumento')
<div class="form-group row">
    <label for="tipoDoc" class="col-md-4 col-form-label text-md-right">Tipo Documento</label>
    <div class="col-md-6">
        <select name="tipoDoc" id="tipoDoc" class="form-control">
            <option value="DNI">DNI</option>
            @foreach ($TipoDocumento->gettipodocumento() as $index => $tipo )
            <option value="{{$index}}"> {{$tipo}}</option>
            @endforeach
        </select>
       {{-- <v-select v-model="selected" :options="options">
            
            @foreach ($TipoDocumento->gettipodocumento() as $index => $tipo )
            <option :value="{{$index}}"> {{$tipo}}</option>
            @endforeach
        </v-select>--}}
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
    <label for="observaciones" class="col-md-4 col-form-label text-md-right">{{ __('Observaciones:') }}</label>

    <div class="col-md-6">
        <input id="observaciones" type="text" class="form-control" name="observaciones">
    </div>
</div>
