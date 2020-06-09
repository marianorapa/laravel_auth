document.addEventListener("DOMContentLoaded", function (event) {

    let submitBtn = document.getElementById('submit');
    submitBtn.disabled = true;

    let btnCalcular = document.getElementById("btnCalcular");
    let infoBtn = document.getElementById('info-btn');
    infoBtn.visible = true;

    let detectValidFormula = function () {

        let filasTrazables = document.getElementsByClassName('filaInsumoTrazable');
        let filasNoTrazables = document.getElementsByClassName('filaInsumoNoTrazable');

        let flag = true;
        let inputs = document.getElementsByTagName('input');

        for (let input of inputs) {
            input.addEventListener('keydown', detectValidFormula)
            input.addEventListener('change', detectValidFormula)
            input.addEventListener('click', detectValidFormula)
            input.addEventListener('keyup', detectValidFormula)
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
            let creditoCliente = parseInt(document.getElementById('creditoCliente').innerText);

            for (let item of filasNoTrazables) {

                let cantidadNecesaria = parseInt(item.getElementsByClassName('cantidadNecesaria')[0].innerText) || 0;

                let cantidadStockCliente = parseInt(item.getElementsByClassName('cantidadStockCliente')[0]
                    .innerText) || 0;

                let cantidadUtilizarCliente = parseInt(item.getElementsByClassName('cantidadUtilizarCliente')[0]
                    .childNodes.item(0).value) || 0;

                let cantidadStockFabrica = parseInt(item.getElementsByClassName('cantidadStockFabrica')[0]
                    .innerText) || 0;

                let cantidadUtilizarFabrica = parseInt(item.getElementsByClassName('cantidadUtilizarFabrica')[0]
                    .childNodes.item(0).value) || 0;


                if (cantidadNecesaria === (cantidadUtilizarCliente + cantidadUtilizarFabrica)) {
                    if (cantidadUtilizarCliente > cantidadStockCliente
                        || cantidadUtilizarFabrica > cantidadStockFabrica
                        || cantidadUtilizarFabrica > creditoCliente){
                            flag = false;
                    }
                } else {
                    flag = false;
                }
            }
        }

        submitBtn.disabled = !flag;
        flag ? infoBtn.classList.add('d-none'): infoBtn.classList.remove('d-none');

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
