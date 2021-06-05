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

function ValidarToken(result) {

    if (!result) {
        const modal_body = document.querySelector('#modal-body');
        modal_body.setAttribute('data-toggle', 'modal');
        modal_body.setAttribute('data-target', '#ModalMultiUso');
        modal_body.textContent = "Falha ao verificar token.Tente novamente.";
        modal_body.click();

        setTimeout(() => {
            window.location.href = "/";
        }, 5000);
    }
}

function fetchRedefinir(){
    event.preventDefault();
    const senha = document.querySelector('#input-senha').value;
    const senhacon = document.querySelector('#input-confirma-senha').value;
    let id = getParams();
    const form = new FormData();
    form.append('_method','PATCH');
    form.append('senha',senha);
    form.append('senhacon',senhacon);
    form.append('_token',document.getElementsByName("_token")[0].value);
    form.append('id',id);
    const url = '/email/redefinicao';
        fetch(url,{
            method: 'POST',
            body: form
        }).then((Response) => {
            let resposta = Response;
            resposta.status !== 200 ? AbrirModal(false,"Falha ao realizar ação.Tente novamente mais tarde") : "";
            return resposta.json();
        }).then((resposta) => {
            if(resposta.result){
                AbrirModal(resposta.result);
            }else{
                AbrirModal(resposta.result,resposta.exception);
            }
        });
}

const input_senha = document.querySelector('#input-senha');
input_senha.addEventListener('input',function () {

    const div_span = document.querySelector('#span-erros');
    div_span.innerHTML = "";

    const span = document.createElement('span');
    span.classList.add('badge');
    span.classList.add('badge-danger');

    TestarQtdCaracteres(span,this.value);
    TestarExistenciaNumero(span,this.value)
    TestarMaiuscula(span,this.value);
    TestarMinuscula(span,this.value);

    if(span.textContent.length === 0){
        HabilitarBotaoCadastro();
    }

    div_span.appendChild(span);
});

function TestarQtdCaracteres(span,senha) {
    if(senha.length < 8){
        DesabilitarBotaoCadastro();

        const text = document.createTextNode("A senha precisa de ao menos 8 dígitos");
        span.appendChild(text);

        const br = document.createElement("br");
        span.appendChild(br);
    }
}

function TestarExistenciaNumero(span,senha) {
    const regex = new RegExp("(?=.*[0-9])");

    if(!regex.test(senha)){
        DesabilitarBotaoCadastro();

        const text = document.createTextNode("A senha precisa de ao menos 1 número");
        span.appendChild(text);

        const br = document.createElement("br");
        span.appendChild(br);
    }
}

function TestarMaiuscula(span,senha) {
    const regex = new RegExp("(?=.*[A-Z])");

    if(!regex.test(senha)){
        DesabilitarBotaoCadastro();

        const text = document.createTextNode("A senha precisa de ao menos uma letra maiúscula");
        span.appendChild(text);

        const br = document.createElement("br");
        span.appendChild(br);
    }
}

function TestarMinuscula(span,senha) {
    const regex = new RegExp("(?=.*[a-z])");

    if(!regex.test(senha)){
        DesabilitarBotaoCadastro();

        const text = document.createTextNode("A senha precisa de ao menos 1 letra minúscula");
        span.appendChild(text);

        const br = document.createElement("br");
        span.appendChild(br);
    }
}

function HabilitarBotaoCadastro(){
    event.preventDefault();
    const input_submit = document.querySelector('#input-submit');
    input_submit.onclick = function () {
        fetchRedefinir();
    }
}

function DesabilitarBotaoCadastro() {
    const input_submit = document.querySelector('#input-submit');
    input_submit.removeAttribute('onclick');
    input_submit.setAttribute('onclick',function () {
        event.preventDefault();
    });
}


function AbrirModal(result,exception) {
    const modal = document.querySelector('#modal-body');
    modal.setAttribute('data-toggle','modal');
    modal.setAttribute('data-target','#ModalMultiUso');

    if(result){
        modal.textContent = "Senha redefinida com sucesso!Logue-se com a nova senha";
        setTimeout(() => {
            window.location.href = "/login";
        },3500);
    }else{
        modal.textContent = exception + ".Tente novamente";
    }

    modal.click();
}

function getParams(){
    let url = window.location.href;
    let regex = /\d+/g;
    let id = url.match(regex);
    id = id[id.length - 1];
    return parseInt(id);
}
//fim

