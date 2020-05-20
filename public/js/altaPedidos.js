var window = window ||{},
    document = document ||{},
    console = console || {};
document.addEventListener("DOMContentLoaded", function(event)
{

    //carga de select de productos
    productos = document.querySelector(".productos");
    cliente_id = document.querySelector(".cliente_id");
    cliente_id.addEventListener("change",function () {
        var id = cliente_id.value;
        axios.get('/getProductoCliente',{
            params:{
                id :id
            }
        })
            .then(function (res) {
                console.log(res.data);
                if (res.status == 200){
                    var i = 0;
                    console.log(res.data);
                    while (i< res.data['length']){
                        opcion = document.createElement("option");
                        opcion.value=res.data[i]['id'];
                        opcion.text=res.data[i]['descripcion'];
                        //console.log(res.data[i]['insumo_trazable_id']);
                        productos.appendChild(opcion);
                        i++;
                    }
                }
            })
            .catch(function (err) {
                console.log(err);
            });
    })

//------CARGA DE TABLAS-------//

    var tablaInsumosNecesarios = document.querySelector(".insumosnecesarios");//TBODY
    var trinsumosnecesarios;//TR
    function limpiarTablaInsumosNecesarios(){
        new_tbody = document.createElement('tbody');
        new_tbody.className = 'insumosnecesarios';
        tablaInsumosNecesarios.parentNode.replaceChild(new_tbody,tablaInsumosNecesarios);
        tablaInsumosNecesarios = document.querySelector(".insumosnecesarios");
    };

    var tablaInsumosCliente = document.querySelector(".tablacliente");
    function limpiarTablaInsumosCliente(){
        new_tbody = document.createElement('tbody');
        new_tbody.className = 'tablacliente';
        tablaInsumosCliente.parentNode.replaceChild(new_tbody,tablaInsumosCliente);
        tablaInsumosCliente = document.querySelector(".tablacliente");
    };

    var tablaInsumosFabrica = document.querySelector(".tablafabrica");
    function limpiarTablaInsumosFabrica(){
        new_tbody = document.createElement('tbody');
        new_tbody.className = 'tablafabrica';
        tablaInsumosFabrica.parentNode.replaceChild(new_tbody,tablaInsumosFabrica);
        tablaInsumosFabrica = document.querySelector(".tablafabrica");
    };

    //tablaInsumosNecesarios = document.querySelector(".insumosnecesarios");
    productos.addEventListener("change",function () {
        /*var productoId = productos.value;
        axios.get('/getFormulaProducto',{
            params:{
                id :productoId
            }
        })
            .then(function (res) {
                console.log(res.data);
                if (res.status == 200){
                    var i = 0;
                    console.log(res.data);
                    limpiarTablaInsumosNecesarios();
                    while (i< res.data['length']){
                        //celda del id
                        th = document.createElement("th");
                        input_id = document.createElement('input');
                        input_id.type = 'hidden';
                        input_id.value = res.data[i]['insumo_id'];
                        input_id.name ='id';
                        th.appendChild(input_id);

                        //celda del insumo
                        tddescripcion = document.createElement('td');
                        input_name = document.createElement('input');
                        input_name.type = 'hidden';
                        input_name.value = res.data[i]['descripcion'];
                        input_name.name ='descripcion';
                        tddescripcion.appendChild(input_name);

                        //celda de la cantidad necesaria
                        tdcantidadnes = document.createElement('td');
                        input_cantidadnes = document.createElement('input');
                        input_cantidadnes.type = 'hidden';
                        input_cantidadnes.value = res.data[i]['proporcion'];
                        input_cantidadnes.name ='cantidadnes';
                        tdcantidadnes.appendChild(input_cantidadnes);

                        //CREO LA FILA
                        tr = document.createElement('tr');
                        tr.appendChild(th);
                        tr.appendChild(tddescripcion);
                        tr.appendChild(tdcantidadnes);

                        tablaInsumosNecesarios.appendChild(tr);
                        i++;
                    }
                }
            })
            .catch(function (err) {
                console.log(err);
            });

            cargarTablaCliente(productoId);
            cargarTablaFabrica(productoId);*/

        //prueba para ver como carga


        filainsumos();
        filaclientes();
        filafabrica();





    });


    // implementar la matriz para cada tabla en cuanto tenga todos los datos para poder cargar.
    function filainsumos () {
        th = document.createElement("th");
        input_id = document.createElement('input');
        input_id.type = 'hidden';
        input_id.value = 1;
        input_id.name ='insumos[1][id_insumo_fila_insumos]';
        th.appendChild(input_id);
        th.appendChild(document.createTextNode('1'));


        tddescripcion = document.createElement('td');
        input_name = document.createElement('input');
        input_name.type = 'hidden';
        input_name.value = 'maiz';
        input_name.name ='insumos[1][descripcion_fila_insumos]';
        tddescripcion.appendChild(input_name);
        tddescripcion.appendChild(document.createTextNode('maiz'));

        tdcantidadstock = document.createElement('td');
        input_cantidadstock = document.createElement('input');
        input_cantidadstock.type = 'hidden';
        input_cantidadstock.value = 54;
        input_cantidadstock.name ='insumos[1][cantidad_fila_insumos]';
        tdcantidadstock.appendChild(input_cantidadstock);
        tdcantidadstock.appendChild(document.createTextNode('54'));

        tr = document.createElement('tr');
        tr.appendChild(th);
        tr.appendChild(tddescripcion);
        tr.appendChild(tdcantidadstock);

        tablaInsumosNecesarios.appendChild(tr);

        th = document.createElement("th");
        input_id = document.createElement('input');
        input_id.type = 'hidden';
        input_id.value = 1;
        input_id.name ='insumos[2][id_insumo_fila_insumos]';
        th.appendChild(input_id);
        th.appendChild(document.createTextNode('1'));


        tddescripcion = document.createElement('td');
        input_name = document.createElement('input');
        input_name.type = 'hidden';
        input_name.value = 'maiz';
        input_name.name ='insumos[2][descripcion_fila_insumos]';
        tddescripcion.appendChild(input_name);
        tddescripcion.appendChild(document.createTextNode('maiz'));

        tdcantidadstock = document.createElement('td');
        input_cantidadstock = document.createElement('input');
        input_cantidadstock.type = 'hidden';
        input_cantidadstock.value = 54;
        input_cantidadstock.name ='insumos[2][cantidad_fila_insumos]';
        tdcantidadstock.appendChild(input_cantidadstock);
        tdcantidadstock.appendChild(document.createTextNode('54'));

        tr = document.createElement('tr');
        tr.appendChild(th);
        tr.appendChild(tddescripcion);
        tr.appendChild(tdcantidadstock);

        tablaInsumosNecesarios.appendChild(tr);


    }
    function filaclientes () {
        th = document.createElement("th");
        input_id = document.createElement('input');
        input_id.type = 'hidden';
        input_id.value = 1;
        input_id.name ='id_insumo_fila_clientes';
        th.appendChild(input_id);
        th.appendChild(document.createTextNode('1'));


        tddescripcion = document.createElement('td');
        input_name = document.createElement('input');
        input_name.type = 'hidden';
        input_name.value = 'maiz';
        input_name.name ='descripcion_fila_clientes';
        tddescripcion.appendChild(input_name);
        tddescripcion.appendChild(document.createTextNode('maiz'));

        tdcantidadstock = document.createElement('td');
        input_cantidadstock = document.createElement('input');
        input_cantidadstock.type = 'hidden';
        input_cantidadstock.value = 54;
        input_cantidadstock.name ='cantidad_fila_clientes';
        tdcantidadstock.appendChild(input_cantidadstock);
        tdcantidadstock.appendChild(document.createTextNode('54'));

        tr1 = document.createElement('tr');
        tr1.appendChild(th);
        tr1.appendChild(tddescripcion);
        tr1.appendChild(tdcantidadstock);

        tablaInsumosCliente.appendChild(tr1);
    }
    function filafabrica () {
        th = document.createElement("th");
        input_id = document.createElement('input');
        input_id.type = 'hidden';
        input_id.value = 1;
        input_id.name ='id_insumo_fila_fabrica';
        th.appendChild(input_id);
        th.appendChild(document.createTextNode('1'));


        tddescripcion = document.createElement('td');
        input_name = document.createElement('input');
        input_name.type = 'hidden';
        input_name.value = 'maiz';
        input_name.name ='descripcion_fila_fabrica';
        tddescripcion.appendChild(input_name);
        tddescripcion.appendChild(document.createTextNode('maiz'));

        tdcantidadstock = document.createElement('td');
        input_cantidadstock = document.createElement('input');
        input_cantidadstock.type = 'hidden';
        input_cantidadstock.value = 54;
        input_cantidadstock.name ='cantidad_fila_fabrica';
        tdcantidadstock.appendChild(input_cantidadstock);
        tdcantidadstock.appendChild(document.createTextNode('54'));

        tr2 = document.createElement('tr');
        tr2.appendChild(th);
        tr2.appendChild(tddescripcion);
        tr2.appendChild(tdcantidadstock);


        tablaInsumosFabrica.appendChild(tr2);


    }

    function cargarTablaCliente($id_producto) {
        var id_cliente = cliente_id.value;

        axios.get('/getClienteProdForm',{
            params:{
                id_prod :$id_producto,
                id_cliente: id_cliente
            }
        })
            .then(function (res) {
                console.log(res.data);
                if (res.status == 200){
                    var i = 0;
                    console.log(res.data);
                    limpiarTablaInsumosCliente()
                    while (i< res.data['length']){
                        //celda del id
                        th = document.createElement("th");
                        input_id = document.createElement('input');
                        input_id.type = 'hidden';
                        input_id.value = res.data[i]['insumo_id'];
                        input_id.name ='id';
                        th.appendChild(input_id);

                        //celda del insumo
                        tddescripcion = document.createElement('td');
                        input_name = document.createElement('input');
                        input_name.type = 'hidden';
                        input_name.value = res.data[i]['descripcion'];
                        input_name.name ='descripcion';
                        tddescripcion.appendChild(input_name);

                        //celda de la cantidad stock
                        tdcantidadstock = document.createElement('td');
                        input_cantidadstock = document.createElement('input');
                        input_cantidadstock.type = 'hidden';
                        input_cantidadstock.value = res.data[i]['cantidad'];
                        input_cantidadstock.name ='cantidad';
                        tdcantidadstock.appendChild(input_cantidadstock);

                        //CREO LA FILA
                        tr = document.createElement('tr');
                        tr.appendChild(th);
                        tr.appendChild(tddescripcion);
                        tr.appendChild(tdcantidadstock);

                        tablaInsumosCliente.appendChild(tr);
                        i++;
                    }
                }
            })
            .catch(function (err) {
                console.log(err);
            });

    }

    function cargarTablaFabrica($id_producto) {
        var id_cliente = cliente_id.value;

        axios.get('/getFabricaProdForm',{
            params:{
                id_prod :$id_producto,
                id_cliente: id_cliente
            }
        })
            .then(function (res) {
                console.log(res.data);
                if (res.status == 200){
                    var i = 0;
                    console.log(res.data);
                    limpiarTablaInsumosFabrica();
                    while (i< res.data['length']){
                        //celda del id
                        th = document.createElement("th");
                        input_id = document.createElement('input');
                        input_id.type = 'hidden';
                        input_id.value = res.data[i]['insumo_id'];
                        input_id.name ='id';
                        th.appendChild(input_id);

                        //celda del insumo
                        tddescripcion = document.createElement('td');
                        input_name = document.createElement('input');
                        input_name.type = 'hidden';
                        input_name.value = res.data[i]['descripcion'];
                        input_name.name ='descripcion';
                        tddescripcion.appendChild(input_name);

                        //celda de la cantidad stock
                        tdcantidadstock = document.createElement('td');
                        input_cantidadstock = document.createElement('input');
                        input_cantidadstock.type = 'hidden';
                        input_cantidadstock.value = res.data[i]['cantidad'];
                        input_cantidadstock.name ='cantidad';
                        tdcantidadstock.appendChild(input_cantidadstock);

                        //CREO LA FILA
                        tr = document.createElement('tr');
                        tr.appendChild(th);
                        tr.appendChild(tddescripcion);
                        tr.appendChild(tdcantidadstock);

                        tablaInsumosFabrica.appendChild(tr);
                        i++;
                    }
                }
            })
            .catch(function (err) {
                console.log(err);
            });

    };

});
