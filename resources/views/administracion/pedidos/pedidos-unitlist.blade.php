<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>  
    <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"></script>
    <link href="{{ asset('css/op.css') }}" rel="stylesheet">
    <title>Orden de produccion</title>
</head>

<body>
<button class="pdf" onclick="generar()">Generar PDF</button>
<div id="pdf">

<div id="wrapper"> 
    <section> 
        <article id="column2">
            <h1>VILUMAR S.A</h1>
            <h2><br> </h2>
            <h2><br></h2>
        </article> 
        <article id="column3">
            <h2>ORDEN DE PRODUCCION</h2>
           
            <p>Numero:  {{ $pedidosnt->first()->id }}</p>
            <?php $fcha = date("Y-m-d");?>
            <label for="">Fecha: <?php echo date("Y-m-d");?></label>
            <p>Fecha entrega: {{ $pedidosnt->first()->fecha_fabricacion }}</p>
        </article> 
    </section>
 </div>

 <div id="wrappercentral1"> 
    <section>
        <article id="central1-izq">
            <p>Cliente: {{ $pedidosnt->first()->nombre_cliente }}</p> 
            <p>Producto: {{ $pedidosnt->first()->prod }}</p>
        </article> 
        <article id="central1-der">
            <p> Kg: {{ $pedidosnt->first()->cantidad }}</p>
        </article>
    </section>
 </div>


 <div id="wrappercentral2"> 
    <section> 
        <article id="central2">
        <div class="table">
            <table class="tabla">
            <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th  scope="col">Producto</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Dueño</th>
                                <th scope="col">Lote</th>

                            </tr>
            </thead>          
                        <tbody>
                        @foreach ($pedidosnt as $op)

                            <tr>
                                <th  class="fila">{{$op->prod_id}}</th>
                                <th class="fila">{{$op->descripcion}}</th>
                                <th class="fila">{{$op->cant}}</th>
                                
                                @if ( $op->cliente_id  == '1')                       
                                    <th class="fila">Fabrica</th>
                                @else                               
                                    <th class="fila">Cliente</th>
                                
                                @endif
                                <th class="fila"> - </th>
                               
                            </tr>
                        @endforeach
                        @foreach ($pedidost as $op)
                            <tr>
                                <th class="fila">{{$op->gtin}}</th>
                                <th class="fila">{{$op->descripcion}}</th>
                                <th class="fila">{{$op->cantidad}}</th>
                                <th class="fila">Cliente</th>
                                <th class="fila">{{ $op->nro_lote}}</th>

                            </tr>
                        @endforeach
                        </tbody>
            </table>
            </div>
        </article> 
    </section>
 </div>

 <div id="wrapper2"> 
    <section> 
        <article id="column5">
            <p>Firma Responsable:</p>
        </article> 
    </section>
 </div>
</body>


<script>
     function generatePDF() {
        // Choose the element that our invoice is rendered in.
        const element = document.getElementById("pdf");
        // Choose the element and save the PDF for our user.
        html2pdf()
          .from(element)
          .save();
      }
      function generar(){
        const element = document.getElementById("pdf");
        const options = {
        margin: 0,
        filename: 'codepen-test.pdf',
        image: {
            type: 'jpeg',
            quality: 0.99
        },
        html2canvas: {
            scale: 2
        },
        jsPDF: {
            unit: 'in',
            format: 'letter',
            orientation: 'portrait'
        }
        }
        html2pdf().from(element).set(options).save();
      }
    </script>
</html>

