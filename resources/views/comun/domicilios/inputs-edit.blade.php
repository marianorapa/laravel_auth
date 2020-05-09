@inject('Provincia', 'App\Provincia')

<div class="form-group row">
    <label for="calle" class="col-md-4 col-form-label text-md-right">{{ __('Calle') }}</label>

    <div class="col-md-6">
        <input id="calle" type="text" class="form-control" name="calle" value="{{$domicilio->calle}}" required>
        @error('calle')
        <span class="invalid-feedback" role="alert">
            <strong>Calle invalida</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="numero" class="col-md-4 col-form-label text-md-right">{{ __('Numero') }}</label>

    <div class="col-md-6">
        <input id="numero" type="text" class="form-control" name="numero" value="{{$domicilio->numero}}" required>
        @error('numero')
        <span class="invalid-feedback" role="alert">
            <strong>Numero invalido</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="piso" class="col-md-4 col-form-label text-md-right">{{ __('Piso') }}</label>

    <div class="col-md-6">
        <input id="piso" type="text" class="form-control" name="piso" value="{{$domicilio->piso}}">
        @error('piso')
        <span class="invalid-feedback" role="alert">
            <strong>Piso invalido</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="dpto" class="col-md-4 col-form-label text-md-right">{{ __('Dpto') }}</label>

    <div class="col-md-6">
        <input id="dpto" type="text" class="form-control" name="dpto" value="{{$domicilio->dpto}}">
        @error('dpto')
        <span class="invalid-feedback" role="alert">
            <strong>Dpto invalido</strong>
        </span>
        @enderror
    </div>
</div>

{{--<div class="form-group row">--}}
{{--    <label for="codigo_postal" class="col-md-4 col-form-label text-md-right">{{ __('Codigo postal') }}</label>--}}

{{--    --}}{{-- Edit 8-05. Marian. Saco cod postal--}}
{{--        <div class="col-md-6">--}}
{{--        <input id="codigo_postal" type="text" class="form-control" name="codigo_postal" value="{{$domicilio->localidad()->first()->codigo_postal}}" required>--}}
{{--        @error('codigo_postal')--}}
{{--        <span class="invalid-feedback" role="alert">--}}
{{--            <strong>Codigo invalido</strong>--}}
{{--        </span>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--</div>--}}

<div class="form-group row">
        <label for="provincia" class="col-md-4 col-form-label text-md-right">Provincia</label>
        <div class="col-md-6">
            <select v-model="selected_provincia" @change="loadLocalidades" name="provincia" id="provincia" class="form-control" required>
                @foreach ($Provincia->getProvincia() as $index => $prov )

                    @if ($domicilio->localidad()->first()->provincia()->first()->descripcion == $prov)
                        <option value="{{$index}}" selected> {{$prov}}</option>
                    @else
                        <option value="{{$index}}"> {{$prov}}</option>
                    @endif
                @endforeach
            </select>
            @error('provincia')
            <span class="invalid-feedback" role="alert">
                <strong>Provincia invalida</strong>
             </span>
            @enderror
        </div>
</div>

<div class="form-group row">
    <label for="localidad" class="col-md-4 col-form-label text-md-right">Localidad</label>

    <div class="col-md-6">
        <select v-model="selected_localidad" name="localidad" id="localidad" class="form-control" required>
            <option value="">Seleccione una localidad</option>
            <option v-for="(localidad, index) in localidades" v-bind:value="index">@{{localidad}}</option>
        </select>
        @error('localidad')
        <span class="invalid-feedback" role="alert">
            <strong>Localidad invalida</strong>
         </span>
        @enderror
    </div>

</div>

