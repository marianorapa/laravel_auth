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
            <h1>Vilumar S.A</h1>
            <h2><br> </h2>
            <h2><br></h2>
        </article> 
        <article id="column3">
            <h2>VALE DE PRODUCCION</h2>
            <p>Fecha Fabricacion:  {{ $pedidosnt->first()->fecha_fabricacion }}</p>
            <p>Numero:  {{ $pedidosnt->first()->id }}</p>
            <?php $fcha = date("Y-m-d");?>
            <label for="">Fecha entrega: <?php echo date("Y-m-d");?></label>
        </article> 
    </section>
 </div>

 <div id="wrappercentral1"> 
    <section>
        <article id="central1-izq">
            <p>Cliente: {{ $pedidosnt->first()->cliente_id }}</p> 
            <p>Producto id: {{ $pedidosnt->first()->producto_id }}</p>
        </article> 
        <article id="central1-der">Kg: {{ $pedidosnt->first()->cantidad }}
            <h2><br></h2>
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
                                <th scope="col">Producto</th>
                                <th scope="col">Cantidad</th>
                            </tr>
            </thead>          
                        <tbody>
                        @foreach ($pedidosnt as $op)
                            <tr>
                                <th >{{$op->prod_id}}</th>
                                <th id="producto">{{$op->prod_id}}</th>
                                <th id="cantidad">{{$op->cant}}</th>
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
        <article id="column4">
            <p>Destino: {{ $pedidosnt->first()->destino }}</p>
        </article> 
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

