function Fetch(verb) {
    let url;
    const msg_falha = "Falha ao realizar ação. Tente novamente com outro login e email.";
    const msg_sucesso = "Cadastro Realizado com sucesso!Confirme seu email e Logue-se.";

    if(verb !== null && verb !== undefined) {
        const Form_Data = new FormData();
        let func;



        if (verb === "POST") {
            Form_Data.append('_method', 'POST');
            Form_Data.append('nome', document.getElementsByName('nome')[0].value);
            Form_Data.append('login', document.getElementsByName('login')[0].value);
            Form_Data.append('email', document.getElementsByName('email')[0].value);
            Form_Data.append('senha', document.getElementsByName('senha')[0].value);
            Form_Data.append('senhacon', document.getElementsByName('senhacon')[0].value);
            Form_Data.append('action','cadastrar_aluno');

            url = "/alunos";
        }
        Form_Data.append('_token', document.getElementsByName('_token')[0].value);
        fetch(url, {
            method: 'POST',
            body: Form_Data,
        }).then((Response) => {
            let resposta = Response;
            if (resposta.status === 200) {
                InformarResultadoAcao(msg_sucesso);
                ApagarAcessoModal();
            } else {
                console.log(resposta.json());
                InformarResultadoAcao(msg_falha);
                ApagarAcessoModal();
            }
        });
    }else{
        InformarResultadoAcao(msg_falha);
        ApagarAcessoModal();
    }

}

function InformarResultadoAcao(content){
    const div_modal_body = document.querySelector("#modal-body");
    div_modal_body.setAttribute("data-toggle","modal");
    div_modal_body.setAttribute("data-target","#ModalMultiUso");
    div_modal_body.textContent = content;
    div_modal_body.click();
}

function ApagarAcessoModal(){

    const div_modal_body = document.querySelector("#modal-body");
    div_modal_body.removeAttribute("data-toggle");
    div_modal_body.removeAttribute("data-target");
}
