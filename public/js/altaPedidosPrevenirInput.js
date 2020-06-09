document.addEventListener("DOMContentLoaded", function (event) {

    let submitBtn = document.getElementById('submit');
    let productos = document.querySelector(".productos");

    submitBtn.disabled = true;

    let btnCalcular = document.getElementById("btnCalcular");

    let detectValidFormula = function () {

        let filasTrazables = document.getElementsByClassName('filaInsumoTrazable');
        let filasNoTrazables = document.getElementsByClassName('filaInsumoNoTrazable');

        let flag = true;
        let inputs = document.getElementsByTagName('input');

        for (let input of inputs) {
            input.addEventListener('change', detectValidFormula)
            input.addEventListener('click', detectValidFormula)
            input.addEventListener('onkeydown', detectValidFormula)
            input.addEventListener('onkeypressed', detectValidFormula)
        }

        for (let item of filasTrazables) {
            let cantidadNecesaria = item.getElementsByClassName('cantidadNecesaria')[0].innerText;
            let cantidadStockCliente = item.getElementsByClassName('cantidadStockCliente')[0].innerText;
            let cantidadStockUtilizar = item.getElementsByClassName('cantidadUtilizarCliente')[0]
                    .childNodes.item(0).value;

            if (cantidadNecesaria === cantidadStockUtilizar) {
                if (!cantidadStockCliente >= cantidadNecesaria) {
                    flag = false;
                }
            } else {
                flag = false;
            }
        }

        if (flag) {
            for (let item of filasNoTrazables) {

                let cantidadNecesaria = item.getElementsByClassName('cantidadNecesaria')[0].innerText;
                let cantidadStockCliente = item.getElementsByClassName('cantidadStockCliente')[0].innerText;
                let cantidadStockUtilizar = item.getElementsByClassName('cantidadUtilizarCliente')[0]
                    .childNodes.item(0).value;;
                let cantidadStockFabrica = item.getElementsByClassName('cantidadUtilizarFabrica')[0]
                    .childNodes.item(0).value;;

                if (cantidadNecesaria === (cantidadStockUtilizar + cantidadStockFabrica)) {
                    if (!cantidadStockCliente >= (cantidadNecesaria - cantidadStockFabrica)) {
                        flag = false;
                    }
                } else {
                    flag = false;
                }
            }
        }

        submitBtn.disabled = !flag;

    }

    btnCalcular.addEventListener('click', function () {
        setTimeout(detectValidFormula, 1500);
        setTimeout(detectValidFormula, 6000);
    })

    //
    //
    // let inputs = document.getElementsByTagName('input');
    //
    // for (let input of inputs){
    //     input.addEventListener('change', detectValidFormula)
    // }


});
