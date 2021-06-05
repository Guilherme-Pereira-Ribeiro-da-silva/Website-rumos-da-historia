//adicionar dinamicidade aos inputs
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
//fim


//validar inputs
const input_submit = document.querySelector("#input-submit");
input_submit.addEventListener("click",function () {
    event.preventDefault();
})


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
    const input_submit = document.querySelector('#input-submit');
    input_submit.onclick = function () {
        Fetch("POST");
    }
}

function DesabilitarBotaoCadastro() {
    const input_submit = document.querySelector('#input-submit');
    input_submit.removeAttribute('onclick');
}
//fim

