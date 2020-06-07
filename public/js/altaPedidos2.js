
var tablaInsumosTrazables = document.getElementById("tableInsumosTrazables");
function limpiarTablaInsumosTrazables() {
    new_tbody = document.createElement('tbody');
    new_tbody.id = "tableInsumosTrazables";
    new_tbody.className = "tableInsumosTrazables";
    tablaInsumosTrazables.parentNode.replaceChild(new_tbody,tablaInsumosTrazables);
    tablaInsumosTrazables = document.getElementById("tableInsumosTrazables");
}
var tablaInsumosNoTrazables = document.getElementById("tableInsumosNoTrazables");
function limpiarTablaInsumosNoTrazables() {
    new_tbody = document.createElement('tbody');
    new_tbody.id = "tableInsumosNoTrazables";
    new_tbody.className = "tableInsumosNoTrazables";
    tablaInsumosNoTrazables.parentNode.replaceChild(new_tbody,tablaInsumosNoTrazables);
    tablaInsumosNoTrazables = document.getElementById("tableInsumosNoTrazables");
}

function filaTrazable(i, element) {
    th = document.createElement("th");
    input_id = document.createElement('input');
    input_id.type = 'hidden';
    input_id.value = element.id_insumo;
    input_id.name ='insumos_trazables['+i+'][id_insumo_fila_insumos]';
    th.appendChild(input_id);
    th.appendChild(document.createTextNode(i.toString()));


    tddescripcion = document.createElement('td');
    tddescripcion.appendChild(document.createTextNode(element.nombre_insumo.toString()));

    tdcantidadNecesaria = document.createElement('td');
    tdcantidadNecesaria.appendChild(document.createTextNode(element.cantidad_requerida.toString()));

    tdLote = document.createElement('td');

    if (element.lotes.length > 0) {

        select_lote = document.createElement('select');
        select_lote.name = 'insumos_trazables['+i+'][lote_insumo]';
        select_lote.addEventListener('change',function () {
            var id_lote = this.value;
            console.log("entro al evento de change");
            var hijos = this.childNodes;
            tdchange = document.querySelector('.td'+i);
            hijos.forEach(hijo =>{
                if (hijo.value== id_lote){
                    tdchange.value = hijo.firstChild.value;
                    tdchange.removeChild(tdchange.firstChild);
                    tdchange.appendChild(document.createTextNode(hijo.firstChild.value));
                };
            })
        })

        element.lotes.forEach(lote =>{
            option = document.createElement('option');
            option.value = lote.nro_lote;
            //option.addEventListener('change',onChangeSelectLote());
            input_pesoStock = document.createElement('input');
            input_pesoStock.type = 'hidden';
            input_pesoStock.name='peso_lote'+lote.nro_lote;
            input_pesoStock.value = lote.cantidad;
            //option.cantidad = lote.cantidad;
            option.appendChild(input_pesoStock);
            option.appendChild(document.createTextNode(lote.nro_lote));
            select_lote.appendChild(option);
        })

        select_lote.selectedIndex = 0;
        tdLote.appendChild(select_lote);

        tdStockLote = document.createElement('td');
        tdStockLote.className="td"+i;
        tdStockLote.appendChild(document.createTextNode(element.lotes[0].cantidad));
    }
    else {
        tdLote.appendChild(document.createTextNode("No existe"));
        tdStockLote = document.createElement('td');
        tdStockLote.appendChild(document.createTextNode("N/A"));
    }

    tdStockUtilizar = document.createElement('td');
    input_stock = document.createElement('input');
    input_stock.name ='insumos_trazables['+i+'][stock_utilizar]';
    input_stock.value=element.cantidad_requerida;
    tdStockUtilizar.appendChild(input_stock);

    tr = document.createElement('tr');
    tr.appendChild(th);
    tr.appendChild(tddescripcion);
    tr.appendChild(tdcantidadNecesaria);
    tr.appendChild(tdLote);
    tr.appendChild(tdStockLote);
    tr.appendChild(tdStockUtilizar);

    tablaInsumosTrazables.appendChild(tr);
}


function filaNoTrazable(i,element) {
    th = document.createElement("th");
    input_id = document.createElement('input');
    input_id.type = 'hidden';
    input_id.value = element.id_insumo;
    input_id.name ='insumos_no_trazables['+i+'][id_insumo_fila_insumos]';
    th.appendChild(input_id);
    th.appendChild(document.createTextNode(i.toString()));


    tddescripcion = document.createElement('td');
    tddescripcion.appendChild(document.createTextNode(element.nombre_insumo.toString()));

    tdcantidadNecesaria = document.createElement('td');
    tdcantidadNecesaria.appendChild(document.createTextNode(element.cantidad_requerida.toString()));

    tdcantidadStockCliente = document.createElement('td');
    tdcantidadStockCliente.appendChild(document.createTextNode(element.stock_cliente.toString()));

    tdStockUtilizar = document.createElement('td');
    input_stock = document.createElement('input');
    input_stock.name ='insumos_no_trazables['+i+'][stock_utilizar]';
    input_stock.value=element.cantidad_requerida;
    tdStockUtilizar.appendChild(input_stock);


    tdcantidadStockfabrica = document.createElement('td');
    tdcantidadStockfabrica.appendChild(document.createTextNode(element.stock_fabrica.toString()));

    tdStockUtilizarFabrica = document.createElement('td');
    input_stockFabrica = document.createElement('input');
    input_stockFabrica.name ='insumos_no_trazables['+i+'][stock_utilizar_Fabrica]';
    if (element.cantidad_requerida>element.stock_cliente){
        input_stockFabrica.value=element.cantidad_requerida-element.stock_cliente;
    }
    tdStockUtilizarFabrica.appendChild(input_stockFabrica);

    tr = document.createElement('tr');
    tr.appendChild(th);
    tr.appendChild(tddescripcion);
    tr.appendChild(tdcantidadNecesaria);
    tr.appendChild(tdcantidadStockCliente);
    tr.appendChild(tdStockUtilizar);
    tr.appendChild(tdcantidadStockfabrica);
    tr.appendChild(tdStockUtilizarFabrica);

    tablaInsumosNoTrazables.appendChild(tr);

}


//window.addEventListener('error', function(event) {
  //  console.log("dasdasds")
    /*axios.get('/getFormulaProducto',{
        params:{
            id :sessionStorage.getItem("producto"),
            cantidad :sessionStorage.getItem("cantidad")
        }
    })
        .then(function (res) {

            console.log(res.data);
            if (res.status == 200){
                var i = 0;
                console.log(res.data);
                limpiarTablaInsumosNoTrazables();
                limpiarTablaInsumosNoTrazables();
                res.data.forEach(element => {
                    if (element.hasOwnProperty("lotes")) {
                        filaTrazable(i, element);
                    }
                    else {
                        filaNoTrazable(i, element);
                    }
                    i++;
                })

            }
        })
        .catch(function (err) {
            console.log(err);
        });*/

//})

