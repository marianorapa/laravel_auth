@inject('Provincia', 'App\Provincia')

<div class="form-group row">
    <label for="calle" class="col-md-4 col-form-label text-md-right">{{ __('Calle') }}</label>

    <div class="col-md-6">
        <input id="calle" type="text" class="form-control" name="calle" value="{{old('calle')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="numero" class="col-md-4 col-form-label text-md-right">{{ __('Numero') }}</label>

    <div class="col-md-6">
        <input id="numero" type="text" class="form-control" name="numero" value="{{old('numero')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="piso" class="col-md-4 col-form-label text-md-right">{{ __('Piso') }}</label>

    <div class="col-md-6">
        <input id="piso" type="text" class="form-control" name="piso" value="{{old('piso')}}">
    </div>
</div>

<div class="form-group row">
    <label for="dpto" class="col-md-4 col-form-label text-md-right">{{ __('Dpto') }}</label>

    <div class="col-md-6">
        <input id="dpto" type="text" class="form-control" name="dpto" value="{{old('dpto')}}">
    </div>
</div>

<div class="form-group row">
    <label for="codigo_postal" class="col-md-4 col-form-label text-md-right">{{ __('Codigo postal') }}</label>

    <div class="col-md-6">
        <input id="codigo_postal" type="text" class="form-control" name="codigo_postal" value="{{old('codigo_postal')}}" required>
    </div>
</div>

<div class="form-group row">
        <label for="provincia" class="col-md-4 col-form-label text-md-right">Provincia</label>

        <div class="col-md-6">
            <select v-model="selected_provincia" @change="loadLocalidades" name="provincia" id="provincia" class="form-control" required>

                @foreach ($Provincia->getProvincia() as $index => $prov )
                    <option value="{{$index}}"> {{$prov}}</option>
                @endforeach
            </select>

        </div>
</div>

<div class="form-group row">
    <label for="localidad" class="col-md-4 col-form-label text-md-right">Localidad</label>

    <div class="col-md-6">
        <select v-model="selected_localidad" name="localidad" id="localidad" class="form-control" required>
            <option value="">Seleccione una localidad</option>
        <option v-for="(localidad, index) in localidades" b-bind:value="index">@{{localidad}}</option>
        </select>

    </div>

</div>

