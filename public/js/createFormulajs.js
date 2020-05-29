var window = window ||{},
    document = document ||{},
    console = console || {};




document.addEventListener("DOMContentLoaded", function(event)
{

    cliente = document.querySelector(".cliente_id");
    productos = document.querySelector(".productos");
    insumos = document.querySelector(".insumo");
    tablageneral = document.querySelector(".tablageneral");

    cliente.addEventListener("change",function () {
        id_cliente = cliente.value;
        cargarProducto(id_cliente);

    });

    function cargarProducto(id_cliente) {
        axios.get('/getProductoCliente',{
            params:{
                id :id_cliente
            }
        })
            .then(function (res) {
                console.log(res.data);
                if (res.status == 200){
                    var i = 0;
                    console.log(res.data);
                    productos.innerHTML="";
                    while (i< res.data['length']){
                        opcion = document.createElement("option");
                        opcion.value=res.data[i]['id'];
                        opcion.text=res.data[i]['descripcion'];
                        productos.appendChild(opcion);
                        i++;
                    }
                }
            })
            .catch(function (err) {
                console.log(err);
            });
    }

    var dat = [];
    select_insumo = document.querySelector(".insumo");
    function cargarinsumo() {
        axios.get('/insumostodosasinc',{
            params:{

            }
        })
            .then(function (res) {
                console.log(res.data);
                if (res.status == 200){
                    var i = 1;
                    console.log(res.data);
                    dat[0]=res.data[0];
                    dat[1]=res.data[1];
                    while (i< res.data[1]){
                        opcion = document.createElement("option");
                        opcion.value=i;
                        opcion.text=res.data[0][i];
                        select_insumo.appendChild(opcion);

                        i++;
                    }
                }
            })
            .catch(function (err) {
                console.log(err);
            });
    }
    cargarinsumo();

    //evento para cargar una fila
    select_insumo.addEventListener("change",function () {
        var i = 1;
        while (i<dat[1]){ //hago esto pq no lo puedo recorrer con el element
            if (i==select_insumo.value){
                filasInsumo(i,dat[0][i]);
            };
            i++;
        };
    })

    //cargar filas de la tabla
    tabla_insumos = document.getElementById("tbodyinsumos");
    function filasInsumo(i,nombre) {
        th = document.createElement("th");
        th.appendChild(document.createTextNode(i));

        td_nombre = document.createElement("td");
        td_nombre.appendChild(document.createTextNode(nombre));

        td_cantidad = document.createElement("td");
        input_cantidad = document.createElement("input");
        input_cantidad.name="insumos["+i+"][cantidad]";
        input_cantidad.className = "form-control proporcion col-md-5";
        td_cantidad.appendChild(input_cantidad);

        td_eliminar = document.createElement("td");
        btn_eliminar = document.createElement("a");
        btn_eliminar.className = "btn btn-danger btneliminarjs";
        btn_eliminar.appendChild(document.createTextNode("Eliminar"));
        td_eliminar.appendChild(btn_eliminar);



        tr = document.createElement('tr');
        tr.appendChild(th);
        tr.appendChild(td_nombre);
        tr.appendChild(td_cantidad);
        tr.appendChild(td_eliminar);
        tabla_insumos.appendChild(tr);

        //evento para eliminar la fila
        btn_eliminar.addEventListener("click",function () {
            tablageneral.deleteRow(tr.rowIndex);
        })
    }


    //falta que no se vuelva a cargar una fila con el mismo insumo
    //falta traer los insumos trazables
    //falta implementar autocomplete porque al tener muchos insumos jode el select

})
