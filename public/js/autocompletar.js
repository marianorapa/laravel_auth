//keyup
window.addEventListener('load',function () {
    divaut = document.querySelector(".divautjs");
    aut = document.querySelector(".autocompletarjs");
    aut.addEventListener('keyup',function () {
        var texto = this.value;
        console.log(texto);
        axios.get('/autocompletar',{
            params:{
                texto :texto
            }
        })
            .then(function (res) {
                console.log(res.data);
                if (res.status == 200){
                    var i = 0;
                    //console.log(res.data);
                    res.data.forEach(element =>{
                        option = document.createElement('option'); //esto no funciona, hay que ver otra forma de hacer el desplegable con las opciones.
                        option.value=element['id'];
                        option.text=element['nombres']+" "+element['apellidos'];

                        divaut.appendChild(option);
                    })
                    }

            })
            .catch(function (err) {
                console.log(err);
            });

    });

});

