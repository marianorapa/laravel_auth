<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de personas</title>
</head>
<body>
    <table>
    <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Fecha Nac</th>
                <th scope="col">Domicilio</th>
                <th scope="col">Telefono</th>
                <th scope="col">Nro Doc</th>
                <th scope="col">Tipo Doc</th>
                <th scope="col">Activo</th>
            </tr>
    </thead>
            <tbody>
                @foreach ($personas as $persona)
                    <tr>
                        <th scope="row">{{$persona->id}}</th>
                        <td>{{$persona->nombres}}</td>
                        <td>{{$persona->apellidos}}</td>
                        <td>{{$persona->personaTipo()->first()->observaciones}}</td>
                        <td>{{$persona->fecha_nacimiento}}</td>
                        <td>{{$persona->personaTipo()->first()->domicilio()->first()->toString()}}</td>
                        <td>{{$persona->personaTipo()->first()->telefono}}</td>
                        <td>{{$persona->personaTipo()->first()->nro_documento}}</td>
                        <td>{{$persona->personaTipo()->first()->tipoDocumento()->first()->descripcion}}</td>    
                    </tr>
                @endforeach
            </tbody>
    </table>
</body>
</html>