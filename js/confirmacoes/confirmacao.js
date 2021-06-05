const true_var = document.querySelector("#true");
const modal = document.querySelector('#modalConfirmacao');
modal.setAttribute('data-toggle','modal');
modal.setAttribute('data-target','#modalConfirmacao');
modal.click();

if(true_var !== undefined){
    setTimeout(() => {
        window.location.href = "/login";
    },5000);
}else{
    setTimeout(() => {
        window.location.href = "/cadastro";
    },5000);
}
