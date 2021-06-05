function ChamarCriacaoCalendario(alterar){
    let data_string;
    let arrow_mes_prox;
    let arrow_mes_ant;

    if(alterar){
        data_string = "data-atual-calendario-alteracao";
        arrow_mes_ant = "mes-anterior-alterar";
        arrow_mes_prox = "mes-proximo-alterar";
    }else{
        data_string = "data-atual-display";
        arrow_mes_ant = "mes-anterior";
        arrow_mes_prox = "mes-proximo";
    }

    let datas = new Date();
    document.querySelector("#" + data_string).textContent = datas.toDateString();
    gerarCalendario(datas,alterar);

    document.querySelector("#" + arrow_mes_ant).addEventListener("click", () => {
        datas.setMonth(datas.getMonth() - 1);
        gerarCalendario(datas,alterar);
    });

    document.querySelector("#" + arrow_mes_prox).addEventListener("click", () => {
        datas.setMonth(datas.getMonth() + 1);
        gerarCalendario(datas,alterar);
    });
}


function gerarCalendario(datas,alterar) {
    datas.setDate(1); //dia 1 mês
    let dias_identifier;
    let mes;
    if(alterar){
        dias_identifier = "#dias";
        mes = "mes-display-alterar";
    }else{
        dias_identifier = ".dias";
        mes = "mes-display";
    }

    let indexes = GetIndexes(datas);
    document.querySelector('#' + mes).textContent = indexes.nome_mes_atual + " de " + datas.getFullYear();

    let dias = "";
    dias = GerarDiasMesPassado(indexes.ultimo_dia_mes_passado,indexes.mes_passado,indexes.primeiro_dia_mes,dias,datas,alterar);
    dias = GerarDiasMesAtual(indexes.mes_atual,indexes.ultimo_dia_mes,dias,datas,alterar);
    dias = GerarDiasMesProximo(indexes.mes_proximo,indexes.dias_proximo_mes,dias,datas,alterar);

    const diasMes = document.querySelector(dias_identifier);
    diasMes.innerHTML = dias;
}

function GerarDiasMesPassado(UltimoDiaMesPrev,mesPassado,PrimeiroDiaMes,dias,datas,alterar){
    let ano = mesPassado === 12 ? datas.getFullYear() - 1 : datas.getFullYear();

    for (let x = PrimeiroDiaMes; x > 0; x--) {
        dias += '<div class="mes-passado" id="'+ mesPassado +'-'+ x + '-' + ano +'" onclick="gerarAgendaDia('+(UltimoDiaMesPrev -x +1)+','+mesPassado+','+ano+',' + JSON.parse(alterar) + ')">' + (UltimoDiaMesPrev -x +1) + '</div>';
    }
    return dias;
}

function GerarDiasMesAtual(mesAtual,UltimoDiaMes,dias,datas,alterar){
    for (let i = 1; i <= UltimoDiaMes; i++) {
        if (i === new Date().getDate() && datas.getMonth() === new Date().getMonth() && datas.getFullYear() === new Date().getFullYear()) {
            dias += '<div class="hoje" id="'+ mesAtual +'-'+ i + '-' + datas.getFullYear() +'" onclick="gerarAgendaDia('+i+','+mesAtual+','+datas.getFullYear()+',' + JSON.parse(alterar) + ')">' + i + '</div>';
        } else {
            dias += '<div id="'+ mesAtual +'-'+ i + '-' + datas.getFullYear() +'" onclick="gerarAgendaDia('+i+','+mesAtual+','+datas.getFullYear()+',' + JSON.parse(alterar) + ')">' + i + '</div>';
        }
    }

    return dias;
}

function GerarDiasMesProximo(mesQueVem,DiasProximoMes,dias,datas,alterar){
    let ano = mesQueVem === 1 ? datas.getFullYear() + 1 : datas.getFullYear();
    for (let j = 1; j <= DiasProximoMes; j++) {
        dias += '<div class="mes-proximo" id="'+ mesQueVem +'-'+ j + '-' + ano +'" onclick="gerarAgendaDia('+j+','+mesQueVem+','+ano+',' + JSON.parse(alterar) + ')">' + j + '</div>';
    }

    return dias;
}

function GetIndexes(datas){
    let IndexUltimoDia = new Date(datas.getFullYear(), datas.getMonth() + 1, 0).getDay();
    let meses = GetMeses();
    return {
        "primeiro_dia_mes": datas.getDay(), //dia semana
        "ultimo_dia_mes": new Date(datas.getFullYear(), datas.getMonth() + 1, 0).getDate(),
        "ultimo_dia_mes_passado": new Date(datas.getFullYear(), datas.getMonth(), 0).getDate(),
        "dias_proximo_mes": 7 - IndexUltimoDia - 1,
        "mes_atual": meses.indexOf(meses[datas.getMonth()]) + 1,
        "mes_passado": meses.indexOf(meses[datas.getMonth()]) === 0 ? 12 : meses.indexOf(meses[datas.getMonth()]),
        "mes_proximo": meses.indexOf(meses[datas.getMonth()]) + 2 === 13 ? 1 : meses.indexOf(meses[datas.getMonth()]) + 2,
        "nome_mes_atual": meses[datas.getMonth()],
    };
}

function GetMeses(){
    return [
        'janeiro',
        'fevereiro',
        'marco',
        'abril',
        'maio',
        'junho',
        'julho',
        'agosto',
        'setembro',
        'outubro',
        'novembro',
        'dezembro'
    ];
}

ChamarCriacaoCalendario(false);
