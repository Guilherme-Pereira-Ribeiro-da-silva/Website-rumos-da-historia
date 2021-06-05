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

function Logar(usertype){
    document.querySelector("#input-submit").onclick = "";
    
    event.preventDefault();
    let url;
    let redirect;

    if(usertype !== null && usertype !== undefined) {
        const login = document.querySelector("#input-login").value;
        const senha = document.querySelector("#input-senha").value;

        if (usertype === "aluno") {
            url = "/login";
            redirect = function (){window.location.href = '/alunos/home'};
        } else if (usertype === "admin") {
            url = "/loginadmin";
            redirect = function (){window.location.href = '/admin'};
        }

        const Form_Data = new FormData;
        Form_Data.append('login', login);
        Form_Data.append('senha', senha);
        Form_Data.append('_token', document.getElementsByName('_token')[0].value);

        fetch(url, {
            method: "POST",
            body: Form_Data
        }).then((Response) => {
            if (Response.status === 200) {
                redirect();
            } else {
                document.querySelector("#input-submit").setAttribute('onclick','Logar('+ JSON.stringify(usertype) +')');
                InformarErro();
                ApagarAcessoModal();
            }
        });
    }else{
        InformarErro();
    }
}

function InformarErro(){
    const modal = document.querySelector("#ModalMultiUso");
    modal.setAttribute('data-toggle','modal');
    modal.setAttribute('data-target','#ModalMultiUso');

    modal.click();
}

function ApagarAcessoModal(){
    const modal = document.querySelector("#ModalMultiUso");
    modal.removeAttribute('data-toggle');
    modal.removeAttribute('data-target');
}
