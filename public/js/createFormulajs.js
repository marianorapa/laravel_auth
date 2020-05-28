var window = window ||{},
    document = document ||{},
    console = console || {};




document.addEventListener("DOMContentLoaded", function(event)
{

    cliente = document.querySelector(".cliente_id");
    productos = document.querySelector(".productos");
    insumos = document.querySelector(".insumo");
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
                    dat[i]=res.data[0];
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

    select_insumo.addEventListener("change",function () {
        //filasInsumo()
        dat.forEach(element=>{
            //if (element.id == select_insumo.value){
                filasInsumo(element)
                console.log(element)
            //}
            console.log("asdasd");
        })
    })

    //cargar filas de la tabla
    tabla_insumos = document.getElementById("tbodyinsumos");
    function filasInsumo(element) {
        th = document.createElement("th");
        th.appendChild(document.createTextNode(element.id));

        tr = document.createElement('tr');
        tr.appendChild(th);

        tabla_insumos.appendChild(tr);
    }

})
