
function Prev() {
    RecolocarCards();

    const botao_prev = document.querySelector('#botao-anterior');
    botao_prev.setAttribute('onclick',"");

    const row_cards = document.querySelector('#row-cards');
    const page = row_cards.getAttribute('page');
    const perpage = row_cards.getAttribute('perpage');


    if (parseInt(page) - 1 === 0) {
        return;
    }

    row_cards.setAttribute('page', parseInt(page) - 1);

    let filhos = row_cards.children;


    for (let i = 0; i <= 2; i++) {
        filhos[i].children[0].classList.add('card-zoom-out');
    }

    setTimeout( () => {
        for (let i = 0; i <= 2; i++) {
            filhos[i].children[0].classList.remove('card-zoom-out');
            filhos[i].children[0].classList.add('card-zoom-in');
        }

        fetchEventosAluno(parseInt(page) - 1, parseInt(perpage));
    }, 600);


    setTimeout(() => {
        for (let i = 0; i <= 2; i++) {
            filhos[i].children[0].classList.remove('card-zoom-in');
        }
        botao_prev.setAttribute('onclick',() => {Prev()});
    }, 1200);

}



function Next(){
    RecolocarCards();

    const botao_next = document.querySelector('#botao-proximo');
    botao_next.setAttribute('onclick',"");

    const row_cards = document.querySelector('#row-cards');
    const page = row_cards.getAttribute('page');
    const perpage = row_cards.getAttribute('perpage');

    row_cards.setAttribute('page',parseInt(page) + 1);

    let filhos = row_cards.children;

    for(let i=0;i<=2;i++){
        filhos[i].children[0].classList.add('card-zoom-out-invertido');
    }

    setTimeout(() => {
        for(let i=0;i<=2;i++){
            filhos[i].children[0].classList.remove('card-zoom-out-invertido');
            filhos[i].children[0].classList.add('card-zoom-in-invertido');
        }
        fetchEventosAluno(parseInt(page) + 1,parseInt(perpage));
    },600);

    setTimeout(() => {
        for (let i = 0; i <= 2; i++) {
            filhos[i].children[0].classList.remove('card-zoom-in-invertido');
        }
        botao_next.setAttribute('onclick',() => {Next()});
    },1200);


};

function fetchEventosAluno(page,perpage){
    const url = "/alunos/eventos/" + page + "/" + perpage;

    fetch(url,{
        method: "GET"
    }).then((Response) => {
        let resposta = Response;
        resposta.status === 200 ? "" : DiminuirPagina();
        return resposta.json();
    }).then((eventos) => {
        eventos = eventos.result;
        let i = 0;
        if(!eventos[0]){
            return;
        }
        eventos.forEach((evento) => {
            TirarCard(eventos.length);
            AtualizarValoresEventoCard(evento,i);
            i = i + 1;
        });
    });
}

function TirarCard(tamanho){

    switch (tamanho){
        case 2:
            document.querySelector("#card-2").classList.add('fade-out');
            break;

        case 1:
            document.querySelector("#card-2").classList.add('fade-out');
            document.querySelector("#card-1").classList.add('fade-out');
            break;

        case 0:
            for(let i = 2;i>=0;i--){
                document.querySelector("#card-" + i).classList.add('fade-out');
            }
            break;

        default:
            return;
    }
}

function RecolocarCards() {
    for(let i=0;i<=2;i++){
        document.querySelector("#card-" + i).classList.remove('fade-out');
    }
}

function AtualizarValoresEventoCard(evento,cardnum){
    const card = document.querySelector("#card-" + cardnum);
    const id = document.querySelector('#id-' + cardnum);
    const nome = document.querySelector('#nome-' + cardnum);
    const data = document.querySelector('#data-' + cardnum);
    const hora = document.querySelector('#hora-' + cardnum);

    let data_evento = evento.mes + "/" + evento.dia + "/" + evento.ano;

    if(!testarPassado(data_evento)){
        card.onclick = () => {AbreModal(evento.id,evento.alteracoes)};
    }else{
        card.classList.remove("cursor-pointer");
        card.onclick = () => {};
    }

    id.textContent = evento.id;
    nome.textContent = evento.nome;
    data.textContent = evento.dia + "/" + evento.mes + "/" + evento.ano ;
    hora.textContent = evento.hora + ":00";
}

fetchEventosAluno(1,3);

function testarPassado(data){
    let data_formatada = new Date(data);
    let agora = new Date();
    agora.setHours(0,0,0,0);
    return  data_formatada < agora;
}

function DiminuirPagina(){
    const row_cards = document.querySelector('#row-cards');
    const page = row_cards.getAttribute('page');

    row_cards.setAttribute('page',parseInt(page) - 1);

    TirarCard(0);
    setTimeout(() => {

    },2000);
}

function AbreModal(id,alteracoes) {
    const button = document.querySelector('#button');
    const modal_precos = document.querySelector("#ModalPrecos");
    const modal_header = document.querySelector('#staticBackdropLabel');
    modal_header.textContent = "Configurações da aula";

    button.setAttribute('data-toggle','modal');
    button.setAttribute('data-target','#ModalPrecos');

    modal_precos.classList.add('animacao-modal');

    if(alteracoes !== null && id !== null){
        MontaModalBodyConfig(id,alteracoes);
        button.click();
    }else{
        InformarFalhaAcao();
    }
}

function MontaModalBodyConfig(id,alteracoes) {
    const modal_body = document.querySelector('#modal-body');
    if(alteracoes < 2){
        modal_body.innerHTML = "<a class='btn btn-outline-dark btn-block' id='alterar-horario' onclick='AgendaUpdate("+ id +")'>Mudar Horário</a>";
    }else{
        modal_body.innerHTML = "<a class='btn btn-outline-danger btn-block disabled'>Você já alterou o horário desta aula o máximo de vezes permitidas</a>";
    }
}

function AgendaUpdate(id) {
    document.querySelector("#id").value = id;

    const a_alterar = document.querySelector("#alterar-horario");

    a_alterar.classList.add("fade-out");
    setTimeout(() => {
        a_alterar.classList.add("d-none");
    },1500);

    const container = document.createElement("div");
    container.classList.add("container-fluid");
    container.classList.add("mt-2");

    const calendario = "<div class=\"calendario\" id=\"calendario-alterar\">\n" +
        "                    <div class=\"mes\">\n" +
        "                        <i class=\"fas fa-angle-left\" id=\"mes-anterior-alterar\"></i>\n" +
        "                        <div class=\"data\">\n" +
        "                            <h2 id=\"mes-display-alterar\"></h2>\n" +
        "                            <p id=\"data-atual-calendario-alteracao\"></p>\n" +
        "                        </div>\n" +
        "                        <i class=\"fas fa-angle-right\" id=\"mes-proximo-alterar\"></i>\n" +
        "                    </div>\n" +
        "                    <div class=\"semana\">\n" +
        "                        <div>Dom</div>\n" +
        "                        <div>Seg</div>\n" +
        "                        <div>Ter</div>\n" +
        "                        <div>Qua</div>\n" +
        "                        <div>Qui</div>\n" +
        "                        <div>Sex</div>\n" +
        "                        <div>Sab</div>\n" +
        "                    </div>\n" +
        "                    <div class=\"dias\" id=\"dias\">\n" +
        "\n" +
        "                    </div>\n" +
        "                </div>";
    container.classList.add("fade-in");
    container.innerHTML = calendario;
    const modalbody =  document.querySelector("#modal-body");
    modalbody.appendChild(container);
    ChamarCriacaoCalendario(true);
}

function InformarFalhaAcao(){
    const modal_body = document.querySelector('#modal-body');
    const loader = document.querySelector('#loader');
    loader.classList.add('esconder-div');
    modal_body.innerText = "Falha ao realizar ação.Verifique se todas as informações estão corretas ou tente novamente mais tarde";
    const button = document.querySelector("#button");
    button.click();
}

function fetchInfoAluno(){
    document.querySelector("#button-confirmar-senha").onclick = "";
    
    const form = new FormData();
    const senha = document.querySelector('#input-senha-user').value;
    form.append('senha',senha);
    form.append('_token',document.getElementsByName('_token')[0].value);
    const url = "/alunos/info";
    fetch(url,{
        method: "POST",
        body: form
    }).then((Response) => {
        document.querySelector("#button-cancelar").click();
        let resposta = Response;
        if(resposta.status === 200){
            return resposta.json();
        }else{
            ModalSenhaIncorreta();
            return false;
        }
    }).then((resposta) =>{
        if(resposta) {
            resposta = Object.values(resposta);
            resposta = resposta[0]['original']['result'][0];
            PreencherInfo(resposta);
        }
    });
}

function PreencherInfo(infoAluno){
    const tdnome = document.querySelector("#td-nome");
    tdnome.classList.add('fade-in-invertido');
    tdnome.textContent = infoAluno['nome'];

    const tdemail = document.querySelector('#td-email');
    tdemail.classList.add('fade-in-invertido');
    tdemail.textContent = infoAluno['email'];

    const tdendereco = document.querySelector('#td-endereco');
    tdendereco.classList.add('fade-in-invertido');
    if(infoAluno['rua'] === null || infoAluno['rua'] === undefined){
        tdendereco.textContent = "Aluno sem endereço cadastrado"
    }else{
        tdendereco.textContent = "Rua " + infoAluno['rua'] + ",bairro " + infoAluno['bairro'] + "," + infoAluno["cidade"] + "," + infoAluno["cep"] + "," + infoAluno["estado"];
    }

    const tdlogin = document.querySelector("#td-login");
    tdlogin.classList.add('fade-in-invertido');
    tdlogin.textContent = infoAluno["login"];

    const button_editar = document.querySelector("#button-editar");
    button_editar.classList.add("fade-out");
    setTimeout(() => {
        button_editar.textContent = "Editar info";
        button_editar.removeAttribute('onclick');
        button_editar.onclick = () => {
            modalEditarInfo();
        } ;
        button_editar.classList.remove('fade-out');
        button_editar.classList.add('fade-in');
    },1000);
}

function ModalSenhaIncorreta(){
    const button = document.querySelector("#button");
    button.setAttribute('data-toggle','modal');
    button.setAttribute('data-target','#ModalPrecos');
    const modal_body = document.querySelector("#modal-body");
    modal_body.innerHTML = "";
    modal_body.textContent = "Senha incorreta.Tente novamente";

    button.click();
}

function PedirSenha() {
    const button = document.querySelector("#button");
    button.setAttribute('data-toggle','modal');
    button.setAttribute('data-target','#ModalPrecos');
    const modal_title = document.querySelector("#staticBackdropLabel");
    modal_title.textContent = "Verificação de senha";
    const modal_body = document.querySelector("#modal-body");

    let content = "<p class='w-100 text-center'>Por favor,digite sua senha:</p>";
    content += "<input class='input-group mb-2' type='password' name='senha' id='input-senha-user'>";
    content += "<button id='button-confirmar-senha' class='btn btn-outline-dark btn-block' onclick='fetchInfoAluno()'>Enviar</button>";

    modal_body.innerHTML = content;

    button.click();
}

function modalEditarInfo() {
    const modal_title = document.querySelector("#staticBackdropLabel");
    modal_title.textContent = "Editar informações";

    const modal_body = document.querySelector("#modal-body");
    let content = "<p class='w-100 text-center text-bold'>Edite suas informações</p>";
    content += "<p class='w-100 text-center h6 mb-4'>Campos vazios manterão seu valor anterior</p>";
    content += "<div class='row'>";
    content += "<div class='col-sm-12 col-md-8'>";
    content += "<input class='input-group mb-2' placeholder='digite seu cep sem o traço' type='number' name='cep' id='cep'>";
    content += "<div class='alert alert-danger mt-2 mb-2' id='alert-erro-busca-cep' hidden>CEP não encontrado</div>";
    content += "</div>"
    content += "<div class='col-sm-12 col-md-4'>";
    content += "<button class='btn btn-outline-dark btn-block ml-1' onclick='CalculaCEP()'>Calcular</button>";
    content += "</div>"
    content += "</div>"
    content += "<p class='w-100 text-center'>Email</p>";
    content += "<input class='input-group mb-2' type='email' name='email' id='email'>";
    content += "<p class='w-100 text-center mb-2'>Rua</p>";
    content += "<input class='input-group mb-2' type='text' name='rua' id='rua' disabled>";
    content += "<p class='w-100 text-center'>Número</p>";
    content += "<input class='input-group mb-2' type='number' name='numero' id='numero'>";
    content += "<p class='w-100 text-center'>Bairro</p>";
    content += "<input class='input-group mb-2' type='text' name='bairro' id='bairro' disabled>";
    content += "<p class='w-100 text-center'>Cidade</p>";
    content += "<input class='input-group mb-2' type='text' name='cidade' id='cidade' disabled>";
    content += "<p class='w-100 text-center'>Estado</p>";
    content += "<input class='input-group mb-2' type='text' maxlength='2' name='estado' id='estado' disabled>";
    content += "<p class='w-100 text-center'>Senha</p>";
    content += "<input class='input-group mb-3' type='password' name='senha' id='senha'>";
    content += "<button class='btn btn-outline-dark btn-block' onclick='fetchEditInfo()'>Enviar</button>";

    modal_body.innerHTML = content;

    document.querySelector("#button").click();
}

function fetchEditInfo() {
    const button_fechar = document.querySelector("#button-cancelar");
    button_fechar.click();
    const url = "/alunos/editar";
    const form = new FormData();
    form.append('_token',document.getElementsByName('_token')[0].value);
    form.append('email',document.querySelector('#email').value);
    form.append('senha',document.querySelector('#senha').value);
    form.append('rua',document.querySelector('#rua').value);
    form.append('numero',document.querySelector('#numero').value);
    form.append('cep',document.querySelector('#cep').value);
    form.append('cidade',document.querySelector('#cidade').value);
    form.append('estado',document.querySelector('#estado').value);
    form.append('bairro',document.querySelector('#bairro').value);
    fetch(url,{
        method: "POST",
        body: form
    }).then((Response) => {
        let resposta = Response;
        if(resposta.status !== 200){
            InformarFalhaAcao();
            return false;
        }else{
            return resposta.json();
        }
    }).then((resposta) => {
        if(resposta){
            InformarSucessoUpdate()
        }
    });
}

function InformarSucessoUpdate() {
    const modal_body = document.querySelector("#modal-body");
    modal_body.innerHTML = "";
    modal_body.textContent = "Ação realizada com sucesso!Você será deslogado em 10 segundos por questões de segurança. Realize os passos necessários e então logue-se com as novas informações!";

    const button_modal = document.querySelector("#button");
    button.click();

    const a_sair =  document.querySelector("#a-sair");

    setTimeout(() => {
        a_sair.click();
    },10000);
}

function CalculaCEP() {
    event.preventDefault();
    const url = "https://viacep.com.br/ws/" + document.querySelector("#cep").value + "/json";

    fetch(url,{
        method: "GET"
    }).then((Response) => {
        let resposta = Response;

        if(resposta.status === 200){
            document.querySelector("#alert-erro-busca-cep").hidden = true;
            return resposta.json();
        }else{
            document.querySelector("#alert-erro-busca-cep").hidden = false;
        }
    }).then((info) => {
        PreencherFormEndereco(info);
    }).catch((erro) => {
        document.querySelector("#alert-erro-busca-cep").hidden = false;
    });
}

function PreencherFormEndereco(info){
    document.querySelector("#rua").value = info.logradouro;
    document.querySelector("#bairro").value = info.bairro;
    document.querySelector("#cidade").value = info.localidade;
    document.querySelector("#estado").value = info.uf;
}
