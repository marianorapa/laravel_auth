@inject('TipoDocumento', 'App\TipoDocumento')
<div class="form-group row">
    <label for="id_tipo_documento" class="col-md-4 col-form-label text-md-right">Tipo Documento</label>
    <div class="col-md-6">
        <select name="id_tipo_documento" id="id_tipo_documento" class="form-control">
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
    <label for="nro_documento" class="col-md-4 col-form-label text-md-right">{{ __('Nro Documento') }}</label>

    <div class="col-md-6">
        <input id="nro_documento" type="text" class="form-control" name="nro_documento" value="{{old('nro_documento')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

    <div class="col-md-6">
        <input id="email" type="tel" class="form-control" name="email" value="{{old('email')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

    <div class="col-md-6">
        <input id="telefono" type="tel" class="form-control" name="telefono" value="{{old('tel')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="observaciones" class="col-md-4 col-form-label text-md-right">{{ __('Observaciones:') }}</label>

    <div class="col-md-6">
        <input id="observaciones" type="text" class="form-control" value="{{old('observaciones')}}" name="observaciones">
    </div>
</div>
