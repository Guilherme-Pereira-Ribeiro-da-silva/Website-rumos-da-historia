function MontaModalHeader(info,deleteadmin) {
    ApagarInfoModal();
    const img = document.querySelector("#img-modal");
    img.setAttribute('alt',info["nome"]);
    img.setAttribute('title',info["nome"]);
    let src;
    if(info["foto"] === null || info["foto"] === undefined){
        src = "/images/alunos/semfoto.png";
    }else{
        src = info['foto'];
    }

    img.setAttribute('src',src);

    const h4_nome = document.querySelector("#nome-modal");
    h4_nome.textContent = info["nome"];

    if(deleteadmin === null || deleteadmin === undefined) {
        MontaModalBody(info);
    }else{
        MontaModalDeleteAdmin(info);
    }
}

function MontaModalBody(aluno) {
    const row_modal_body = document.querySelector("#modal-body-row");

    CriaColSm6('Nome:',row_modal_body);
    CriaColSm6(aluno["nome"],row_modal_body);

    CriaColSm6('Email:',row_modal_body);
    CriaColSm6(aluno["email"],row_modal_body);

    CriaColSm6('Login:',row_modal_body);
    CriaColSm6(aluno["login"],row_modal_body);


    if(aluno["rua"] !== null && aluno["rua"] !== undefined) {
        CriaColSm6('Estado:', row_modal_body);
        CriaColSm6(aluno["estado"], row_modal_body);

        CriaColSm6('Cidade:', row_modal_body);
        CriaColSm6(aluno["cidade"], row_modal_body);

        CriaColSm6('Bairro:', row_modal_body);
        CriaColSm6(aluno["bairro"], row_modal_body);

        CriaColSm6('Rua:', row_modal_body);
        CriaColSm6(aluno["rua"], row_modal_body);

        CriaColSm6('CEP:', row_modal_body);
        CriaColSm6(aluno["cep"], row_modal_body);
    }
}

function CriaColSm6(info,row){
    const col_sm_6 = document.createElement("div");
    col_sm_6.classList.add("col-sm-6");
    col_sm_6.classList.add("mb-2");
    col_sm_6.classList.add("rem-07");
    col_sm_6.textContent = info;

    row.appendChild(col_sm_6);
}


function ApagarInfoModal(){
    const row_modal_header = document.querySelector("#row-modal-header");
    row_modal_header.hidden = false;

    const row_modal_body = document.querySelector("#modal-body-row");
    const botao_apagar = document.querySelector('#botao-apagar-admin');
    const form = document.querySelector('#form-criar-admin');
    form.hidden = true;

    if(botao_apagar !== null && botao_apagar !== undefined) {
        botao_apagar.parentElement.removeChild(botao_apagar); //DOM não permite que o elmento se suicide, então o pai o mata
    }

    row_modal_body.innerHTML = "";
}


function MontaModalDeleteAdmin(admin){
    ApagarInfoModal();

    const modal_body = document.querySelector('#modal-body-row');
    modal_body.textContent = "Tem certeza que deseja deletar este admin?essa ação é irreversível."
    CriaBotaoDelete(admin["id"]);
}

function CriaBotaoDelete(id){
    const modal_footer = document.querySelector('#modal-footer');
    const botao = document.createElement('button');
    botao.classList.add('btn');
    botao.classList.add('btn-outline-dark');
    botao.setAttribute('id','botao-apagar-admin');
    botao.textContent = "Apagar";
    botao.onclick = function (){Fetch(id,"DELETE")};
    botao.setAttribute('data-dismiss','modal');

    modal_footer.appendChild(botao);
}

function MontaModalCreateAdmin() {
    ApagarInfoModal();

    EsconderModalHeader();

    const form = document.querySelector('#form-criar-admin');
    form.hidden = false;
}

function InformarFalhaAcao(){
    ApagarInfoModal();
    EsconderModalHeader();
    const row_modal_body = document.querySelector("#modal-body-row");
    row_modal_body.textContent = "Falha ao realizar a ação.Verifique se todas as informações obrigatórias foram inseridas ou tente novamente mais tarde.";
}

function InformarSucessoAcao(){
    ApagarInfoModal();
    EsconderModalHeader();
    const row_modal_body = document.querySelector("#modal-body-row");
    row_modal_body.textContent = "Sucesso ao realizar ação.Recerregue a página e veja os resultados";
}

function EsconderModalHeader(){
    const row_modal_header = document.querySelector("#row-modal-header");
    row_modal_header.hidden = true;
}
