var window = window ||{},
    document = document ||{},
    console = console || {};




document.addEventListener("DOMContentLoaded", function(event)
{
    btn_buscar = document.querySelector('.buscarjs');
    btn_buscar.addEventListener('click',function(){
        sessionStorage.setItem('nombre2js',document.querySelector('.nombre2js').value);
        sessionStorage.setItem('apellidojs',document.querySelector('.apellidojs').value);
        sessionStorage.setItem('nrodocjs',document.querySelector('.nrodocjs').value);
    });

    btn_pdf = document.querySelector('.btn_pdf');
    btn_pdf.addEventListener('click',function () {
        console.log("entro")
        axios.get('/personapdf',{
            params:{
                nombre: sessionStorage.getItem('nombre2js'),
                apellido: sessionStorage.getItem('apellidojs'),
                documento: sessionStorage.getItem('nrodocjs')
            }
        })
            .then(function (res) {
                console.log(res.data);
                if (res.status == 200){
                    console.log(res);
                    
                }
            })
            .catch(function (err) {
                console.log(err);
            });
    });

});
