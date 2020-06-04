var window = window || {},
    document = document || {},
    console = console || {};
document.addEventListener("DOMContentLoaded", function() {




    //funcion para generar nro random en un pesaje.
    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min)) + min;
    }
    butonPesaje = document.querySelector(".pesajeAleatorio");
    butonPesaje.addEventListener("click",function () {
        inputPesaje = document.getElementById("tara");
        inputPesaje.value = getRandomInt(13000,15000);
    })
    //producto
    validar_nombre = document.querySelector(".nombreprod");
    validar_nombre.addEventListener("blur", function() {
        /*var nombre = /^[a-zA-Z]{3,40}$/;
        if (nombre.exec(validar_nombre.value)) {
            validar_nombre.style.background = "#ffffff";
        } else {
            validar_nombre.style.background = "#e05f5f";
        }*/
    });

    //patente
    validar_patente = document.querySelector(".patentejs");
    validar_patente.addEventListener("blur", function() {
        var patente = /^[a-zA-Z]{3}[0-9]{3}$/;
        var patente2 = /^[a-zA-Z]{2}[0-9]{3}[a-zA-Z]{2}$/;
        if (validar_patente.value !== ""){

            if (patente.exec(validar_patente.value) || patente2.exec(validar_patente.value)) {
                validar_patente.style.background = "#ffffff";
            } else {
                validar_patente.style.background = "#e05f5f";
            }
        };
    });

    //tarajs
    validar_tara = document.querySelector(".tarajs");
    validar_tara.addEventListener("blur", function() {
        var integers = /^(100(\.0{1,9})?|[0-9]?[0-9]|([0-9]{1,8})|([0-9]{1,8}(\.[0-9]{1,2}))|([0-9]?[0-9](\.[0-9]{1,2})))$/;
        /*if (integers.exec(validar_tara.value)) {
            validar_tara.style.background = "#ffffff";
        } else {
            validar_tara.style.background = "#e05f5f";
        }*/
    });




    tbody = document.querySelector(".tbodyop");
    select_cliente = document.querySelector('.cliente_select');
    select_cliente.addEventListener('change',function (){
        var id_cliente = select_cliente.value;
        axios.get('/getOP',{
            params:{
                id :id_cliente
            }
        })
            .then(function (res) {
                console.log(res.data);
                if (res.status == 200){
                    var i = 0;
                    console.log(res.data);
                    res.data.forEach(element=>{
                        cargarTablaOp(i,element)
                        i++;
                    })
                }
            })
            .catch(function (err) {
                console.log(err);
            });
    });

    select_idop = document.querySelector(".selectop");

    select_idop.addEventListener("change",function () {
        prod = sessionStorage.getItem(select_idop.value);
        document.querySelector(".nombreprod").value =prod;
    })
    function cargarTablaOp(i,element) {
        //cargo el select
        option_sop = document.createElement('option');
        option_sop.text=element.id;
        option_sop.value = element.id;
        select_idop.appendChild(option_sop);



        id = document.createElement('th');
        /*input_id = document.createElement('input');
        input_id.readOnly = "true";
        input_id.className = "ReadOnly form-control";
        input_id.value=element.id;
        input_id.type = "text";
        id.appendChild(input_id);*/
        id.innerText = element.id;


        fecha_entrega = document.createElement('td');
        /*input_fe = document.createElement('input');
        input_fe.readOnly = "true";
        input_fe.className = "ReadOnly form-control";
        input_fe.value=element.fecha_fabricacion;
        input_fe.type = "text";
        fecha_entrega.appendChild(input_fe);*/
        fecha_entrega.innerText=element.fecha_fabricacion;


        producto = document.createElement('td');
        /*input_p = document.createElement('input');
        input_p.readOnly = "true";
        input_p.className = "ReadOnly form-control";
        input_p.value=element.producto_id;
        input_p.type = "text";
        producto.appendChild(input_p);*/
        producto.innerText= element.descripcion;


        cant_disponible = document.createElement('td');
        /*input_cd = document.createElement('input');
        input_cd.readOnly = "true";
        input_cd.className = "ReadOnly form-control";
        input_cd.value=element.saldo;
        input_cd.type = "text";
        cant_disponible.appendChild(input_cd);*/
        cant_disponible.innerText = element.saldo;

        fila = document.createElement('tr');
        fila.appendChild(id);
        fila.appendChild(fecha_entrega);
        fila.appendChild(producto);
        fila.appendChild(cant_disponible);
        tbody.appendChild(fila);

        sessionStorage.setItem(element.id,element.descripcion);
        //carga

    }



});
