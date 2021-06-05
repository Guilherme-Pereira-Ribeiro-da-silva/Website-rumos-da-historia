function MostrarPlanos(hora,dia,mes,ano,periodo){
    const conteudo_especifico = document.querySelector("#textarea-area-especifica").value;

    const titulo_modal = document.querySelector('#staticBackdropLabel');
    titulo_modal.textContent = "Escolha uma modalidade";
    const modal_body = document.querySelector('#modal-body');
    modal_body.innerHTML = "";

    const div = document.createElement('div');
    div.classList.add('row');
    div.setAttribute("id","row-cards-planos");

    CriarColunas(div,hora,dia,mes,ano,periodo,conteudo_especifico);
    modal_body.appendChild(div);
}

function CriarColunas(row,hora,dia,mes,ano,periodo,conteudo) {
    const div1 = document.createElement('div');
    div1.classList.add('col-sm-12');
    div1.classList.add('col-md-6');
    div1.classList.add('mb-2');
    // div1.classList.add('d-flex');
    // div1.classList.add('justify-content-center');

    const div2 = document.createElement('div');
    div2.classList.add('col-sm-12');
    div2.classList.add('col-md-6');
    // div1.classList.add('d-flex');
    // div1.classList.add('justify-content-center');

    CriarDetalhes(div1,div2,hora,dia,mes,ano,periodo,conteudo);

    row.appendChild(div1);
    row.appendChild(div2);
}

function CriarDetalhes(col1,col2,hora,dia,mes,ano,periodo,conteudo){
    col1.innerHTML = "<div id='card-online' class='card text-center cursor-pointer' onclick='FetchPagSeguro(" + dia + ","+ mes + "," + ano + "," + hora+"," + JSON.stringify(periodo) +"," + JSON.stringify(conteudo)+ "," + 1 +")'><figure class='titulo rounded-circle'><img class='rounded-circle imagem-plano border border-dark' src='../images/home/planos/foguete.jpg' alt='avião'></figure>" +
        "<p>Online</p><p>R$ 50,00</p><p><i class='fa fa-check text-success' aria-hidden='true'></i> 1 hora/aula</p><p><i class='fa fa-check text-success' aria-hidden='true'></i> Mapa Conceitual</p></div>";

    col2.innerHTML = "<div id='card-presencial' class='card text-center cursor-pointer'onclick='MontarCalculo(" + dia + ","+ mes + "," + ano + "," + hora+"," + JSON.stringify(periodo) +"," + JSON.stringify(conteudo)+")'><figure class='titulo rounded-circle'><img class='rounded-circle imagem-plano border border-dark' src='../images/home/planos/foguete.jpg' alt='avião'></figure>" +
        "<p>Presencial</p><p>R$ A consultar</p><p><i class='fa fa-check text-success' aria-hidden='true'></i> 1 hora/aula</p><p><i class='fa fa-check text-success' aria-hidden='true'></i> Mapa Conceitual</p></div>";
}

function MontarCalculo(dia,mes,ano,hora,periodo,conteudo){
    document.querySelector("#card-presencial").onclick = "";
    document.querySelector("#card-online").onclick = "";
    
    const url = "/alunos/testeendereco";
    let erro = false;

    fetch(url,{
        method: "GET"
    }).then((Response) => {
        let resposta = Response;

        if(resposta.status !== 200){
            InformarErroAcao();
            erro = true;
        }else{
            return resposta.json();
        }
        return false;
    }).then((resposta) => {
        if(resposta.result){
            GetCep(dia,mes,ano,hora,periodo,conteudo);
        }else{
            if(!erro){
                PegarEnderecoUsuario(dia,mes,ano,hora,periodo,conteudo);
            }
        }
        console.log(resposta.result);
    });
}

function FetchPagSeguro(dia,mes,ano,hora,periodo,conteudo,tipo_aula){
    GetToken(dia,mes,ano,hora,periodo,conteudo,tipo_aula);
}

function InformarErroAcao(){
    const row_cards = document.querySelector("#row-cards-planos");
    row_cards.classList.add("fade-out");

    const div = document.createElement("div");
    div.classList.add("fade-in-invertido");
    div.innerText = "Erro ao carregar os dados requisitados.Tente novamente";

    setTimeout(() => {
        row_cards.parentNode.removeChild(row_cards);
        const modal_body = document.querySelector("#modal-body");
        modal_body.appendChild(div);
    },1500);
}

function PegarEnderecoUsuario(dia,mes,ano,hora,periodo,conteudo){
    const row_cards = document.querySelector("#row-cards-planos");
    row_cards.classList.add("fade-out");

    const div = document.createElement("div");
    div.classList.add("fade-in-invertido");

    div.innerHTML = "" +
        "<h6 class='mb-2'><b>Complete suas informa&ccedil;&otilde;es para poder agendar aulas presenciais:</b></h6>" +
        "<form>\n" +

        "  <div class=\"form-group\">\n" +
        "    <label for=\"cep\">CEP</label>\n" +
        "<div class='row'>\n" +
        "<div class='col-md-8 col-sm-12'>\n" +
        "<input class='input-group mb-2' placeholder='digite seu cep sem o tra&ccedil;o' type='number' name='cep' id='cep'>\n" +
        "<div class='alert alert-danger mt-2 mb-2' id='alert-erro-busca-cep' hidden>CEP n&atilde;o encontrado</div>\n" +
        "</div>\n" +
        "<div class='col-md-4 col-sm-12 mb-2'>\n" +
        "<button class='btn btn-outline-dark btn-block' onclick='CalculaCEP()'>Calcular</button>\n" +
        "</div>" +
        "</div>" +
        "  </div>\n" +

        "  <div class=\"form-group\">\n" +
        "    <label for=\"numero\">N&uacute;mero</label>\n" +
        "    <input type=\"number\" class=\"form-control\" id=\"numero\">\n" +
        "  </div>\n" +

        "  <div class=\"form-group\">\n" +
        "    <label for=\"rua\">Rua</label>\n" +
        "    <input type=\"text\" class=\"form-control\" id=\"rua\" disabled>\n" +
        "  </div>\n" +

        "  <div class=\"form-group\">\n" +
        "    <label for=\"bairro\">Bairro</label>\n" +
        "    <input type=\"text\" class=\"form-control\" id=\"bairro\" disabled>\n" +
        "  </div>\n" +

        "  <div class=\"form-group\">\n" +
        "    <label for=\"cidade\">Cidade</label>\n" +
        "    <input type=\"text\" class=\"form-control\" id=\"cidade\" disabled>\n" +
        "  </div>\n" +

        "  <div class=\"form-group\">\n" +
        "    <label for=\"estado\">Estado</label>\n" +
        "<input class='form-control' id='estado' maxlength='2' disabled>" +
        "  </div>\n" +

        "  <button type=\"submit\" class=\"btn btn-outline-dark\" onclick='testarEndereco(JSON.stringify(dia),JSON.stringify(mes),JSON.stringify(ano),JSON.stringify(hora),JSON.stringify(periodo),JSON.stringify(conteudo))'>Salvar Endere&ccedil;o</button>\n" +
        "<div class='alert alert-danger mt-2' id='erros-form-endereco' hidden>" +
        "</div>" +
        "</form>";

    setTimeout(() => {
        row_cards.parentNode.removeChild(row_cards);
        const modal_body = document.querySelector("#modal-body");
        modal_body.appendChild(div);
    },1500);
}

function testarEndereco(dia,mes,ano,hora,periodo,conteudo){
    const alert_erros = document.querySelector("#erros-form-endereco");
    let erros_html = "";
    let nenhum_erro = true;
    event.preventDefault();
    let endereco = {};
    endereco.numero = document.querySelector("#numero").value;
    endereco.rua = document.querySelector("#rua").value;
    endereco.bairro = document.querySelector("#bairro").value;
    endereco.cidade = document.querySelector("#cidade").value;
    endereco.estado = document.querySelector("#estado").value;
    endereco.cep = document.querySelector("#cep").value;

    let nomes = Object.keys(endereco);

    for (let i = 0; i < nomes.length; i++) {
        let nome = endereco[nomes[i]];

        if(nome === undefined || nome.length === 0){
            erros_html += "<p>O campo " + nomes[i] + " n&atilde;o pode ser vazio;</p>";
            nenhum_erro = false;
        }
    }

    if(!nenhum_erro){
        alert_erros.innerHTML = erros_html;
        alert_erros.hidden = false;
    }else{
        EditarEnderecoAluno(endereco,dia,mes,ano,hora,periodo,conteudo);
    }
}

function EditarEnderecoAluno(endereco,dia,mes,ano,hora,periodo,conteudo){
    const url = "/alunos/editar";
    const form = new FormData();
    form.append('_token',document.getElementsByName('_token')[0].value);
    form.append('rua',endereco.rua);
    form.append('numero',endereco.numero);
    form.append('cep',endereco.cep);
    form.append('cidade',endereco.cidade);
    form.append('estado',endereco.estado);
    form.append('bairro',endereco.bairro);
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
            GetCep(dia,mes,ano,hora,periodo,conteudo);
        }
    });
}

function CalcularPrecoAula(info,dia,mes,ano,hora,periodo,conteudo) {

    const modalbody = document.querySelector("#modal-body");
    modalbody.classList.add("fade-out");

    const div = document.createElement("div");
    div.classList.add("fade-in-invertido");
    div.classList.add('d-flex');
    div.classList.add('justify-content-center');

    div.innerHTML = "<div class='row'>" +
        "<div class='col-12 text-center mb-2'><h6><b>Modalidade escolhida: aula presencial</b></h6></div>" +
        "<div class='col-12 mb-2 img-plano'>" +
        "<img src='/images/alunos/cards/professor.png'  alt='professor' title='professor'>" +
        "</div>" +

        "<div class='col-12 text-center'>" +
        "<p><b>A sua ditancia at&eacute; n&oacute;s, do cep "+ info.cep +" &eacute; de: "+ info.distancia +"  km</b></p>" +
        "</div>" +

        "<div class='col-12 text-center mb-2'>" +
        "<p><b>Isso dar&aacute; um total de: R$ " + info.preco+",00</b></p>" +
        "</div>" +
        "<div class='col-12 mb-2'><button class='btn btn-outline-dark btn-block mb-1' onclick='FetchPagSeguro(" + JSON.stringify(dia) + "," + JSON.stringify(mes)+ "," +JSON.stringify(ano)+ "," +JSON.stringify(hora)+ "," +JSON.stringify(periodo)+ "," +JSON.stringify(conteudo) + "," + 2 +")'>Agendar</button></div>" +
        "<div class='col-12 text-right'>Como funciona nossa cobran&ccedil;a?</div>" +
        "</div>";

    setTimeout(() => {
        modalbody.classList.remove("fade-out");
        modalbody.innerHTML = "";
        modalbody.appendChild(div);
    }, 1500);
}

function GetCep(dia,mes,ano,hora,periodo,conteudo){
    const url = "/alunos/cep";
    fetch(url,{
        method: "GET"
    }).then(((Response) => {
        let resposta = Response;
        if(resposta.status === 200){
            return resposta.json();
        }else{
            InformarFalhaPresencial();
            return false;
        }
    })).then((resposta) => {
        if(resposta) {
            CalcularPrecoAula(resposta.result, dia, mes, ano, hora, periodo, conteudo);
        }
    });
}

function InformarFalhaPresencial() {
    const modalbody = document.querySelector("#modal-body");
    modalbody.classList.add("fade-out");

    setTimeout(() => {
        modalbody.classList.remove("fade-out");
        modalbody.innerHTML = "&Eacute; uma pena, mas parece que estamos muito longe para irmos at&eacute; ai! Mas ainda &eacute; poss&iacute;vel agendar aulas online conosco!";
        modalbody.classList.add("fade-in-invertido");
    },1500);
}
