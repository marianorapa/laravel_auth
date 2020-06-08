<head>
    <title>Ticket salida</title>
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"></script>
    <link href="{{ asset('css/ticketingreso.css') }}" rel="stylesheet">
</head>

<button class="btn" onclick="generar()">Descargar PDF</button>

<div id="pdf">
    
    <div class="all">
        <div class="titulo">
            <h2>TICKET ENTRADA</h2>
            <P> <BR></BR></P>
        </div>
        
        <div class="contenedor">
            <div class="central">
                <div class="receipt-section pull-left">    
            </div>
        </div>

<div id="wrapper"> 
    <section> 
        <article id="column2">
        <?php $fcha = date("Y-m-d");?>
            <span class="receipt-label text-large distancia">Fecha: </span><label for=""><?php echo date("Y-m-d");?><br> </label>
            <span class="receipt-label text-large distancia">Número: </span> <span class="text-large">{{ $ticketEntrada->id }} <br></span>
            <span class="receipt-label text-large distancia">Comprobante asociado: </span> <span class="text-large">{{ $ticketEntrada->cbte_asociado }} <br></span>
                <span class="receipt-label text-large distancia">Cliente: </span> <span class="text-large">{{ $ticketEntrada->denominacion }} <br></span>
                <span class="receipt-label text-large distancia">Transportista: </span> <span class="text-large">{{ $transportista->denominacion }} <br></span>
                <span class="receipt-label text-large distancia">Patente: </span> <span class="text-large">{{ $ticketEntrada->patente }} <br></span>
        </article> 
        <article id="column3">
            <span class="receipt-label text-large distancia">Insumo: </span> <span class="text-large">{{ $insumo }} <br></span>
                <span class="receipt-label text-large distancia">Lote: </span> <span class="text-large">{{ $lote }} <br></span>
                <span class="receipt-label text-large distancia">Bruto: </span> <span class="text-large">{{ $bruto->peso }} Kg <br></span>
                <span class="receipt-label text-large distancia">Tara: </span> <span class="text-large">{{ $tara->peso }} Kg <br></span>
                <span class="receipt-label text-large distancia">Neto: </span> <span class="text-large">{{ $ticketEntrada->neto }} Kg <br></span>
        </article> 
    </section>
 </div>



        <div class="footer">
            <div class="receipt-signature col-xs-6">
                <h2><br></h2>
                <h2><br></h2>
                <p class="receipt-line"></p>
                <p>Vilumar SA</p>
                <p>2323-596823</p>
                <p>Giles, Buenos Aires, Argentina</p>
            </div>
            
</div>
</div>
<script>
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

