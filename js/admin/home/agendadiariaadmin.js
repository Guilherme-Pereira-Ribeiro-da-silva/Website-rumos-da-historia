function gerarAgendaDia(dia,mes,ano){
    const tituloAgenda = document.querySelector('#titulo-agenda');
    tituloAgenda.textContent = "Agenda do dia " + dia + "/" + mes + "/" + ano;
    GetEventos(dia,mes,ano);
    realocarCalendario();
}

function realocarCalendario(){
    const calendario = document.querySelector('#calendario');
    calendario.classList.remove('abrirCalendario');
    calendario.classList.add('calendario-esquerda-horizontal');
    setTimeout(() => {
        calendario.classList.add('d-none')
        mostrarAgenda()
    },1000)

}

function mostrarAgenda(){
    const agenda = document.querySelector('#agenda');
    agenda.classList.remove('fechar-agenda');
    agenda.classList.remove('d-none');
    agenda.classList.add('agenda-horizontal');
}

function fecharAgenda() {
    DesmontarAgenda();
    const agenda = document.querySelector('#agenda');
    agenda.classList.remove('agenda-horizontal');
    agenda.classList.add('fechar-agenda');
    setTimeout(() => {
        agenda.classList.add('d-none');
    },1000);

    mostrarCalendario();
}

function mostrarCalendario() {
    const calendario = document.querySelector('#calendario');
    calendario.classList.remove('calendario-esquerda-horizontal');
    setTimeout(() => {
        calendario.classList.remove('d-none');
        calendario.classList.add('abrirCalendario');
    },1000)
}

function GetEventos(dia,mes,ano) {
    const formdata = new FormData();
    formdata.append('dia',dia);
    formdata.append('mes',mes);
    formdata.append('ano',ano);

    const url = "/eventos/" +dia+ "/" +mes+ "/" +ano;

    fetch(url,{
        method: 'GET',
    }).then((Response) => {
        return Response.json();
    }).then((resposta) =>{
        if(resposta.result[0] !== false) {
            let array = resposta.result[0];
            array.forEach((evento) => {
                MontarAgenda(evento);
            });
        }
    });
}

function MontarAgenda(evento) {
    evento.hora = parseInt(evento.hora);

        let content;
        if(parseInt(evento.confirmado) === 1){
            content = evento.nome + "-" + "Pago";
        }else{
            content = evento.nome + "-" + "Não pago";
        }
         switch (evento.hora) {
            case 14:
                const td_duas_horas = document.querySelector('#duas-horas');
                MudarConteudoTd(td_duas_horas, content);
                setarOnclickModal(td_duas_horas, evento.alunos);
                setarAberturaModal(td_duas_horas);
                break;

            case 15:
                const td_tres_horas = document.querySelector('#tres-horas');
                MudarConteudoTd(td_tres_horas, content);
                setarOnclickModal(td_tres_horas, evento.alunos);
                setarAberturaModal(td_tres_horas);
                break;

            case 16:
                const td_quatro_horas = document.querySelector('#quatro-horas');
                MudarConteudoTd(td_quatro_horas, content);
                setarOnclickModal(td_quatro_horas, evento.alunos);
                setarAberturaModal(td_quatro_horas);
                break;

            case 17:
                const td_cinco_horas = document.querySelector('#cinco-horas');
                MudarConteudoTd(td_cinco_horas, content);
                setarOnclickModal(td_cinco_horas, evento.alunos);
                setarAberturaModal(td_cinco_horas);
                break;

            case 18:
                const td_seis_horas = document.querySelector('#seis-horas');
                MudarConteudoTd(td_seis_horas, content);
                setarOnclickModal(td_seis_horas, evento.alunos);
                setarAberturaModal(td_seis_horas);
                break;

            case 19:
                const td_sete_horas = document.querySelector('#sete-horas');
                MudarConteudoTd(td_sete_horas, content);
                setarOnclickModal(td_sete_horas, evento.alunos);
                setarAberturaModal(td_sete_horas);
                break;
        }
}

function setarAberturaModal(td){
    td.setAttribute('data-toggle','modal');
    td.setAttribute('data-target','#modalMultiUso');
}

function setarOnclickModal(td,info){
    td.onclick = () =>{MontaModalHeader(info)};
    td.classList.add('cursor-pointer');
}

function MudarConteudoTd(td,conteudo) {
    td.textContent = conteudo;
}

function DesmontarAgenda() {
    const td_duas_horas = document.querySelector('#duas-horas');
    const td_tres_horas = document.querySelector('#tres-horas');
    const td_quatro_horas = document.querySelector('#quatro-horas');
    const td_cinco_horas = document.querySelector('#cinco-horas');
    const td_seis_horas = document.querySelector('#seis-horas');
    const td_sete_horas = document.querySelector('#sete-horas');

    let content = "vago";
    MudarConteudoTd(td_duas_horas,content);
    MudarConteudoTd(td_tres_horas,content);
    MudarConteudoTd(td_quatro_horas,content);
    MudarConteudoTd(td_cinco_horas,content);
    MudarConteudoTd(td_seis_horas,content);
    MudarConteudoTd(td_sete_horas,content);


}
