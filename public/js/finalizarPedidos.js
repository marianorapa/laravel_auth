var window = window ||{},
    document = document ||{},
    console = console || {};
document.addEventListener("DOMContentLoaded", function(event)
{
    cliente = document.querySelector(".cliente");
    cliente.addEventListener("change",function () {
        var id_cliente= cliente.value;
        axios.get('/getOpCliente',{
            params:{
                id :id_cliente
            }
        })
            .then(function (res) {
                console.log(res.data);
                if (res.status == 200){
                    var i = 0;
                    console.log(res.data);
                    res.data.forEach(element =>{
                        
                    })
                }
            })
            .catch(function (err) {
                console.log(err);
            });
    })

});
