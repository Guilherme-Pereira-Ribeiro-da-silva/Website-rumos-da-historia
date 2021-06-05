const inputs = document.querySelectorAll(".input");


function adicionar_classe_focus(){
    let parent = this.parentNode.parentNode;
    parent.classList.add("focus");
}

function remover_classe_focus(){
    let parent = this.parentNode.parentNode;

    if(this.value.length === 0){
        parent.classList.remove("focus");
    }
}


inputs.forEach(input => {
    input.addEventListener("focus", adicionar_classe_focus);
    input.addEventListener("blur", remover_classe_focus);
});

function fetchRecuperar(){
    event.preventDefault();
    const email = document.querySelector('#input-email').value;
    const form = new FormData();
    form.append('email',email);
    form.append('_token',document.getElementsByName('_token')[0].value);
    const url = "/login/recuperar";
    
    fetch(url,{
        method: "POST",
        body: form
    }).then((Response) => {
        return Response.json();
    }).then((resposta) => {
       AbrirModal(resposta.result);
    });
}

function AbrirModal(result) {
    const modal = document.querySelector('#modal-body');
    modal.setAttribute('data-toggle','modal');
    modal.setAttribute('data-target','#ModalMultiUso');

    if(result){
        modal.textContent = "Um email com as instruções de recuperação lhe foi enviado com sucesso!Olha sua caixa de entrada ou a de spam";
    }else{
        modal.textContent = "Email não encontrado em nossa base de dados.Tem certeza de que está usando o email correto?";
    }

    modal.click();
}
