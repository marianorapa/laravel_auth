/*$('.basicAutoComplete').autoComplete({
    resolverSettings: {
        url: ''
    }
});*/



function deleteRow(btn) {
    var row = btn.parentNode.parentNode;
    sessionStorage.removeItem(row.firstChild.textContent);
    row.parentNode.removeChild(row);



}
