
var window = window ||{},
document = document ||{},
console = console || {};
document.addEventListener("DOMContentLoaded", function(event)
{

    check_habilitar = document.querySelector(".checknrolote")
    //elaboracion = document.querySelector(".fechaelaboracion");
    //vencimiento = document.querySelector(".fechavencimiento");
    check_habilitar.addEventListener("change", function(){

            if (check_habilitar.checked){
                document.getElementById("fechavencimiento").disabled = false;
                document.getElementById("fechaelaboracion").disabled = false;
                document.getElementById('nrolote').disabled= false;


                   } else{
                    document.getElementById('nrolote').disabled = true;
                    document.getElementById("fechaelaboracion").disabled = true;
                    document.getElementById("fechavencimiento").disabled = true;
                   }


    });

    //funcion para generar nro random en un pesaje.
    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min)) + min;
    }
    butonPesaje = document.querySelector(".pesajeAleatorio");
    butonPesaje.addEventListener("click",function () {
        inputPesaje = document.getElementById("pesaje");
        inputPesaje.value = getRandomInt(38000,40000);
    })

    //evento donde se carga select de insumos de forma dinamica
    selectInsumo = document.querySelector(".selectInsumo");
    proveedor_id = document.querySelector(".selectProveedor");
    check_habilitar.addEventListener("click",function () {
       var id = proveedor_id.value;
       var i, L = selectInsumo.options.length - 1;
       for(i = L; i >= 0; i--) {
           selectInsumo.remove(i);
       }
       if (check_habilitar.checked){

           axios.get('/insumosasinc',{
               params:{
                   id :id
               }
           })
               .then(function (res) {
                   if (res.status == 200){
                       var i = 0;
                       console.log(res.data);
                        while (i< res.data['length']){
                            opcion = document.createElement("option");
                            opcion.value=res.data[i]['insumo_trazable_id'];
                            opcion.text=res.data[i]['descripcion'];
                            console.log(res.data[i]['insumo_trazable_id']);
                            selectInsumo.appendChild(opcion);
                           i++;
                        }
                   }
               })
               .catch(function (err) {
                   console.log(err);
               });

       }else{
          getinsumos();
       }

    } );

    function getinsumosproveedor() {
        var id = proveedor_id.value;
        var i, L = selectInsumo.options.length - 1;
        for(i = L; i >= 0; i--) {
            selectInsumo.remove(i);
        }
        axios.get('/insumosasinc',{
            params:{
                id :id
            }
        })
            .then(function (res) {
                if (res.status == 200){
                    var i = 0;
                    //console.log(res.data);
                    while (i< res.data['length']){
                        opcion = document.createElement("option");
                        opcion.value=res.data[i]['id'];
                        opcion.text=res.data[i]['descripcion'];
                        opcion.name = "insumo";
                        //console.log(res.data[i]['insumo_trazable_id']);
                        selectInsumo.appendChild(opcion);
                        i++;
                    }
                }
            })
            .catch(function (err) {
                console.log(err);
            });
    }
    function getinsumos() {
        var i, L = selectInsumo.options.length - 1;
        for(i = L; i >= 0; i--) {
            selectInsumo.remove(i);
        }
        axios.get('/insumostodosasinc',{
        })
            .then(function (res) {
                if (res.status == 200){
                    console.log(res.data);
                    for (i=1; i<=res.data[1]; i++){
                        opcion = document.createElement("option");
                        opcion.value=i
                        opcion.text=res.data[0][i];
                        opcion.name = "insumo";
                        console.log(res.data[0][i]);
                        selectInsumo.appendChild(opcion);
                    }
                }
            })
            .catch(function (err) {
                console.log(err);
            });
    }


    proveedor_id.addEventListener("change",function () {
        if (check_habilitar.checked){
            getinsumosproveedor();
        }
    });

    // hago esto para que cargue al principio en la carga de la pagina
    getinsumos();
    document.getElementById('nrolote').disabled = true;
    document.getElementById("fechaelaboracion").disabled = true;
    document.getElementById("fechavencimiento").disabled = true;


});
