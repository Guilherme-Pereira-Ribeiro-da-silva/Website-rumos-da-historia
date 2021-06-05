function gerarAgendaDia(dia,mes,ano,alterar){
    let data = [
        dia,
        mes,
        ano
    ]

    let tituloAgenda;

    if(alterar){
        CriarHTMLagendaAlteracao();
        tituloAgenda = "titulo-agenda-alterar";
    }else{
        tituloAgenda = "titulo-agenda";
    }

    GerarOnclicksModal(data,alterar);

    if(TestarFimdeSemana(dia,mes,ano) || TestarDiaPassado(dia,mes,ano)){
        DesmontarAgenda('Dia Indisponível',false,alterar);
    }else{
        GetEventos(dia,mes,ano,alterar);
    }

    tituloAgenda = document.querySelector('#' + tituloAgenda);
    tituloAgenda.textContent = "Agenda do dia " + dia + "/" + mes + "/" + ano;

    realocarCalendario(alterar);
}

function GerarOnclicksModal(data,alterar) {
    let duas_horas;
    let tres_horas;
    let quatro_horas;
    let cinco_horas;
    let seis_horas;
    let sete_horas;

    if(alterar){
        duas_horas = "duas-horas-alterar";
        tres_horas = "tres-horas-alterar";
        quatro_horas = "quatro-horas-alterar";
        cinco_horas = "cinco-horas-alterar";
        seis_horas = "seis-horas-alterar";
        sete_horas = "sete-horas-alterar";
    }else{
        duas_horas = "duas-horas";
        tres_horas = "tres-horas";
        quatro_horas = "quatro-horas";
        cinco_horas = "cinco-horas";
        seis_horas = "seis-horas";
        sete_horas = "sete-horas";
    }

    const td_duas_horas = document.querySelector('#' + duas_horas);
    const td_tres_horas = document.querySelector('#' + tres_horas);
    const td_quatro_horas = document.querySelector('#' + quatro_horas);
    const td_cinco_horas = document.querySelector('#' + cinco_horas);
    const td_seis_horas = document.querySelector('#' + seis_horas);
    const td_sete_horas = document.querySelector('#' + sete_horas);

    td_duas_horas.onclick = () => {MostrarModal(14,data,alterar)};
    td_tres_horas.onclick = () => {MostrarModal(15,data,alterar)};
    td_quatro_horas.onclick = () => {MostrarModal(16,data,alterar)};
    td_cinco_horas.onclick = () => {MostrarModal(17,data,alterar)};
    td_seis_horas.onclick = () => {MostrarModal(18,data,alterar)};
    td_sete_horas.onclick = () => {MostrarModal(19,data,alterar)};
}

function realocarCalendario(alterar){

    let calendario_identifier = alterar ? "calendario-alterar" : "calendario";

    const calendario = document.querySelector('#' + calendario_identifier);
    calendario.classList.remove('abrirCalendario');
    calendario.classList.add('calendario-esquerda-horizontal');
    setTimeout(() => {
        calendario.classList.add('d-none')
        mostrarAgenda(alterar)
    },1000);

}

function mostrarAgenda(alterar){
    let agenda_identifier;

    if(alterar){
        agenda_identifier = "agenda-alterar";
    }else{
        agenda_identifier = "agenda";
    }

    const agenda = document.querySelector('#' + agenda_identifier);
    agenda.classList.remove('fechar-agenda');
    agenda.classList.remove('d-none');
    agenda.classList.add('agenda-horizontal');
}

function fecharAgenda(alterar) {
    let agenda_identifier;

    if(alterar){
        agenda_identifier = "agenda-alterar";
    }else{
        agenda_identifier = "agenda";
    }

    const agenda = document.querySelector('#' + agenda_identifier);
    agenda.classList.remove('agenda-horizontal');
    agenda.classList.add('fechar-agenda');
    setTimeout(() => {
        agenda.classList.add('d-none');
        DesmontarAgenda('Agendar este horário',true);
    },1000);
    mostrarCalendario(alterar);
}

function mostrarCalendario(alterar) {
    let calendario_identifier;

    if(alterar){
        calendario_identifier = "calendario-alterar";
    }else{
        calendario_identifier = "calendario";
    }

    const calendario = document.querySelector('#' + calendario_identifier);
    calendario.classList.remove('calendario-esquerda-horizontal');
    setTimeout(() => {
        calendario.classList.remove('d-none');
        calendario.classList.add('abrirCalendario');
    },1000)
}

function GetEventos(dia,mes,ano,alterar) {
    const formdata = new FormData();
    formdata.append('dia',dia);
    formdata.append('mes',mes);
    formdata.append('ano',ano);

    const url = "eventos/" +dia+ "/" +mes+ "/" +ano;

    fetch(url,{
        method: 'GET',
    }).then((Response) => {
        return Response.json();
    }).then((resposta) =>{
        if(resposta.result[0] !== false) {
            let array = resposta.result[0];
            array.forEach((evento) => {
                MontarAgenda(evento,alterar);
            });
        }
    });
}

function MontarAgenda(evento,alterar) {
    evento.hora = parseInt(evento.hora);
    let duas_horas;
    let tres_horas;
    let quatro_horas;
    let cinco_horas;
    let seis_horas;
    let sete_horas;

    if(alterar){
        duas_horas = "duas-horas-alterar";
        tres_horas = "tres-horas-alterar";
        quatro_horas = "quatro-horas-alterar";
        cinco_horas = "cinco-horas-alterar";
        seis_horas = "seis-horas-alterar";
        sete_horas = "sete-horas-alterar";
    }else{
        duas_horas = "duas-horas";
        tres_horas = "tres-horas";
        quatro_horas = "quatro-horas";
        cinco_horas = "cinco-horas";
        seis_horas = "seis-horas";
        sete_horas = "sete-horas";
    }

    switch (evento.hora){
        case 14:
            const td_duas_horas = document.querySelector('#' + duas_horas);
            MudarConteudoTd(td_duas_horas,"Horário já agendado",false);
            break;

        case 15:
            const td_tres_horas = document.querySelector('#' + tres_horas);
            MudarConteudoTd(td_tres_horas,"Horário já agendado",false);
            break;

        case 16:
            const td_quatro_horas = document.querySelector('#' + quatro_horas);
            MudarConteudoTd(td_quatro_horas,"Horário já agendado",false);
            break;

        case 17:
            const td_cinco_horas = document.querySelector('#' + cinco_horas);
            MudarConteudoTd(td_cinco_horas,"Horário já agendado",false);
            break;

        case 18:
            const td_seis_horas = document.querySelector('#' + seis_horas);
            MudarConteudoTd(td_seis_horas,"Horário já agendado",false);
            break;

        case 19:
            const td_sete_horas = document.querySelector('#' + sete_horas);
            MudarConteudoTd(td_sete_horas,"Horário já agendado",false);
            break;
    }
}

function CriarHTMLagendaAlteracao(){
    const modal_body = document.querySelector("#modal-body");
    const div = document.createElement("div");
    div.innerHTML = "<div class=\"h-50 w-75 agenda d-none\" id=\"agenda-alterar\">\n" +
        "                    <h5 class=\"text-dark p-2\" id=\"titulo-agenda-alterar\"></h5>\n" +
        "                    <div class=\"table-responsive\">\n" +
        "                        <table class=\"table table-striped\">\n" +
        "                            <thead>\n" +
        "                            <tr>\n" +
        "                                <th>\n" +
        "                                    Horário\n" +
        "                                </th>\n" +
        "                                <th>\n" +
        "                                    Atividade\n" +
        "                                </th>\n" +
        "                            </tr>\n" +
        "                            </thead>\n" +
        "                            <tbody>\n" +
        "                            <tr>\n" +
        "                                <td>\n" +
        "                                    14:00\n" +
        "                                </td>\n" +
        "                                <td id=\"duas-horas-alterar\" class=\"verde cursor-pointer\" onclick=\"MostrarModal(14)\">\n" +
        "                                    <b>Agendar este horário</b>\n" +
        "                                </td>\n" +
        "                            </tr>\n" +
        "                            <tr>\n" +
        "                                <td >\n" +
        "                                    15:00\n" +
        "                                </td>\n" +
        "                                <td id=\"tres-horas-alterar\" class=\"verde cursor-pointer\" onclick=\"MostrarModal(15)\">\n" +
        "                                    <b>Agendar este horário</b>\n" +
        "                                </td>\n" +
        "                            </tr>\n" +
        "                            <tr>\n" +
        "                                <td>\n" +
        "                                    16:00\n" +
        "                                </td>\n" +
        "                                <td id=\"quatro-horas-alterar\" class=\"verde cursor-pointer\"  onclick=\"MostrarModal(16)\">\n" +
        "                                    <b>Agendar este horário</b>\n" +
        "                                </td>\n" +
        "                            </tr>\n" +
        "                            <tr>\n" +
        "                                <td>\n" +
        "                                    17:00\n" +
        "                                </td>\n" +
        "                                <td id=\"cinco-horas-alterar\" class=\"verde cursor-pointer\"  onclick=\"MostrarModal(17)\">\n" +
        "                                    <b>Agendar este horário</b>\n" +
        "                                </td>\n" +
        "                            </tr>\n" +
        "                            <tr>\n" +
        "                                <td>\n" +
        "                                    18:00\n" +
        "                                </td>\n" +
        "                                <td id=\"seis-horas-alterar\" class=\"verde cursor-pointer\"  onclick=\"MostrarModal(18)\">\n" +
        "                                    <b>Agendar este horário</b>\n" +
        "                                </td>\n" +
        "                            </tr>\n" +
        "                            <tr>\n" +
        "                                <td>\n" +
        "                                    19:00\n" +
        "                                </td>\n" +
        "                                <td id=\"sete-horas-alterar\" class=\"verde cursor-pointer\"  onclick=\"MostrarModal(19)\">\n" +
        "                                    <b>Agendar este horário</b>\n" +
        "                                </td>\n" +
        "                            </tr>\n" +
        "                            </tbody>\n" +
        "                        </table>\n" +
        "                    </div>\n" +
        "                    <hr>\n" +
        "                    <div class=\"w-100 d-flex justify-content-end\">\n" +
        "                        <button class=\"btn btn-outline-dark m-2 zoom-on-hover\" id=\"btn-fechar\" onclick=\"fecharAgenda(true)\">fechar</button>\n" +
        "                    </div>\n" +
        "                </div>\n" +
        "            </div>\n" +
        "        </div>";
    modal_body.appendChild(div);
}

function MudarConteudoTd(td,conteudo,textbold=false) {


    if(textbold === true){
        td.innerHTML = "<b>" + conteudo + "</b>";
        td.classList.add("cursor-pointer");
        td.classList.remove('vermelho-opaco');
        td.classList.add('verde');
    }else{
        td.textContent = conteudo;
        td.classList.remove('cursor-pointer');
        td.classList.remove('verde');
        td.classList.add('vermelho-opaco');
        td.onclick = "";
    }
}

function DesmontarAgenda(content,bold=false,alterar) {
    let duas_horas;
    let tres_horas;
    let quatro_horas;
    let cinco_horas;
    let seis_horas;
    let sete_horas;

    if(alterar){
        duas_horas = "duas-horas-alterar";
        tres_horas = "tres-horas-alterar";
        quatro_horas = "quatro-horas-alterar";
        cinco_horas = "cinco-horas-alterar";
        seis_horas = "seis-horas-alterar";
        sete_horas = "sete-horas-alterar";
    }else{
        duas_horas = "duas-horas";
        tres_horas = "tres-horas";
        quatro_horas = "quatro-horas";
        cinco_horas = "cinco-horas";
        seis_horas = "seis-horas";
        sete_horas = "sete-horas";
    }

    const td_duas_horas = document.querySelector('#' + duas_horas);
    const td_tres_horas = document.querySelector('#' + tres_horas);
    const td_quatro_horas = document.querySelector('#' + quatro_horas);
    const td_cinco_horas = document.querySelector('#' + cinco_horas);
    const td_seis_horas = document.querySelector('#' + seis_horas);
    const td_sete_horas = document.querySelector('#' + sete_horas);



    MudarConteudoTd(td_duas_horas,content,bold);
    MudarConteudoTd(td_tres_horas,content,bold);
    MudarConteudoTd(td_quatro_horas,content,bold);
    MudarConteudoTd(td_cinco_horas,content,bold);
    MudarConteudoTd(td_seis_horas,content,bold);
    MudarConteudoTd(td_sete_horas,content,bold);


}


function TestarFimdeSemana (dia,mes,ano) {
    let data = new Date();

    data.setDate(dia);
    data.setMonth(mes - 1);
    data.setFullYear(ano);

    return data.getDay() === 6 || data.getDay() === 0;
}

function TestarDiaPassado(dia,mes,ano) {
    let data_atual = new Date();
    let data_comparacao = new Date();
    data_comparacao.setDate(dia);
    data_comparacao.setMonth(mes - 1);
    data_comparacao.setFullYear(ano);
    return data_comparacao.setHours(0, 0, 0, 0) - data_atual.setHours(0, 0, 0, 0) <= 0;


}


function MostrarModal(hora,data,alterar){

    if(alterar){
        if(!TestarVinteQuatroHoras(data,hora)){
            const modal_body = document.querySelector('#modal-body');
            modal_body.innerHTML = "<a class='btn btn-outline-danger btn-block disabled'>Você não pode alterar o horário de uma aula que acontecerá em menos de um dia</a>";
        }else{
            confirmarMudanca(data,hora);
        }
    }else{
        const modal = document.querySelector('#ModalPrecos');
        modal.classList.add('animacao-modal');


        const button = document.querySelector("#button");
        button.setAttribute('data-toggle','modal');
        button.setAttribute('data-target','#ModalPrecos');
        button.click();
        mostrarTimeline(hora,data);
    }
}

function TestarVinteQuatroHoras(data,hora){
    const data_atual = new Date();
    const data_teste = new Date(data[0],data[1],data[2],hora,0,0);

    return data_atual - data_teste > 24;
}

function confirmarMudanca(data,hora){
    const id = document.querySelector("#id").value;
    const modal_body = document.querySelector("#modal-body");
    let data_formatada = data[0] + "/" + data[1] + "/" + data[2];

    let html  = "<p class='text-justify'>Tem certeza de que deseja alterar o horário da aula para o dia "+ data_formatada +" às " + hora +":00?</p>";
    html += "<button class='btn btn-outline-dark mb-2 btn-block' onclick='FetchAlterar("+data[2]+","+data[1]+","+data[0]+","+hora+")'>Confirmar</button>";

    modal_body.innerHTML = html;
}

function FetchAlterar(ano,mes,dia,hora){
    const formdata = new FormData();
    formdata.append('dia',dia);
    formdata.append('mes',mes);
    formdata.append('ano',ano);
    formdata.append('hora',hora);
    formdata.append('_token',document.getElementsByName("_token")[0].value);
    const url = "/alunos/eventos/alterar/" + document.querySelector("#id").value;

    fetch(url,{
        method: 'POST',
        body: formdata
    }).then((Response) => {
        let content_sucesso = "Horário da aula alterado com sucesso!";
        let content_falha = "Falha ao realizar ação.";
        Response.status === 200 ? InformarAcao(content_sucesso) : InformarAcao(content_falha);
    });
}

function InformarAcao(content){
    const modalbody = document.querySelector("#modal-body");
    modalbody.innerHTML = content + "A página será recarregada por questões de segurança";

    setTimeout(() => {
        window.location.reload();
    },3000);
}

