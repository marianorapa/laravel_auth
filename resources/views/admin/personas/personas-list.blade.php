<head>
    <title>Informe de personas</title>
    <script src="{{ asset('css/informe.css') }}"></script>
</head>

<style>
    table {
    width: 100%;
    border: 1px solid #000;
    }
    th, td {
    width: auto;
    text-align: left;
    vertical-align: top;
    border: 1px solid #000;
    border-collapse: collapse;
    padding: 0.3em;
    caption-side: bottom;
    }
    caption {
    padding: 0.3em;
    color: #fff;
        background: #000;
    }
    th {
    background: #eee;
    }
    h2{
        text-align: center;
        float: center;
        width: 100%;
        padding-top: 1%;
    }
    div img{
        height: 10%;
        width: 10%;
        float: left;
    }
    .contenedor{
        padding-top: 10%;
    }
</style>

    <div class="titulo">

        <h2>Informe de Personas</h2>
        <img src="data:image/jpeg;base64,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" >
    </div>

    <div class="contenedor">
    <table class="">
    <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Fecha Nac</th>
                <th scope="col">Domicilio</th>
                <th scope="col">Telefono</th>
                <th scope="col">Tipo Doc</th>
                <th scope="col">Nro Doc</th>               
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
                        <td>{{$persona->personaTipo()->first()->tipoDocumento()->first()->descripcion}}</td> 
                        <td>{{$persona->personaTipo()->first()->nro_documento}}</td>                                             
                    </tr>
                @endforeach
            </tbody>
    </table>
    </div>

   <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <div id="piechart" style="width: 900px; height: 500px;"></div>-->