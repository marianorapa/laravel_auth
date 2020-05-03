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

    <label for="codigo_postal" class="col-md-4 col-form-label text-md-right">{{ __('Codigo postal') }}</label>

    <div class="col-md-6">
        <input id="codigo_postal" type="text" class="form-control" name="codigo_postal" required>
    </div>

    <script>
        alert("asdasd");
        $(document).ready(function(){
            $(#provincia).on('change', function(){

                var provincia_id =  $(this).val();
                if ($.trim($provincia_id) != '') {
                    $.get('localidades' , {$provincia_id: provincia_id}, function(localidades){
                        $('#localidad').empty();
                        $('#localidad').append("<option value=''> Seleccione una localidad</option>");
                        $.each(localidades, function (index,descripcion) {
                            $('#localidad').append("<option value='" + index + "'>" + descripcion +"</option>");
                        })
                    });
                }
            });
        });
    </script>

    <div class="form-group row">
        <label for="provincia" class="col-md-4 col-form-label text-md-right">Provincia</label>

        <div class="col-md-6">
            <select name="provincia" id="provincia" class="form-control" >
                <option value="">Selecione una provincia</option>
                @foreach ($Provincia->getProvincia() as $index => $prov )
                    <option value="{{$index}}"> {{$prov}}</option>
                @endforeach
            </select>

        </div>

    </div>

    <div class="form-group row">
        <label for="localidad" class="col-md-4 col-form-label text-md-right">Localidad</label>

        <div class="col-md-6">
            <select name="localidad" id="localidad" class="form-control" >

            </select>

        </div>

    </div>
</div>
