@extends('layouts.app')

@section('content')
@inject('Provincia', 'App\Provincia')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-warning">
                Registro de usuario administrador
            </div>

            <div class="card">
                <div class="card-header">{{ __('Registro por primera vez') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Nombre usuario') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Las passwords ingresadas no coinciden</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="descr" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                            <div class="col-md-6">
                                <input id="descr" type="text" class="form-control" name="descr" value="{{ old('descr') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nombresPersona" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>

                            <div class="col-md-6">
                                <input id="nombresPersona" type="text" class="form-control" name="nombresPersona" value="{{ old('nombresPersona') }}" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="apellidos" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

                            <div class="col-md-6">
                                <input id="apellidos" type="text" class="form-control" name="apellidos" value="{{ old('apellidos') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fechaNac" class="col-md-4 col-form-label text-md-right">{{ __('Fecha nacimiento') }}</label>

                            <div class="col-md-6">
                                <input id="fechaNac" type="date" class="form-control" name="fechaNac" value="{{ old('fechaNac') }}" required>
                            </div>
                        </div>

                        <!--<div class="form-group row">
                            <label for="direccion" class="col-md-4 col-form-label text-md-right">{{ __('Domicilio') }}</label>

                            <div class="col-md-6">
                                <input id="direccion" type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" required>
                            </div>
                        </div>-->

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

                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                            <div class="col-md-6">
                                <input id="tel" type="tel" class="form-control" name="tel" value="{{ old('tel') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tipoDoc" class="col-md-4 col-form-label text-md-right">Tipo Documento</label>
                           <div class="col-md-6">
                                <select name="tipoDoc" id="tipoDoc" class="form-control" value="{{ old('tipoDoc') }}">
                                    <option value="DNI">DNI</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nroDocumento" class="col-md-4 col-form-label text-md-right">{{ __('Nro Documento') }}</label>

                            <div class="col-md-6">
                                <input id="nroDocumento" type="text" class="form-control" name="nroDocumento" value="{{ old('nroDocumento') }}" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrarse') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>  

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
@endsection


