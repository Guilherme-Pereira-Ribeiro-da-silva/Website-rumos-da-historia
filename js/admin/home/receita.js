const input_ano = document.querySelector('#ano-receita');
let num_aulas;
let receita;

input_ano.addEventListener("keyup",(event) => {

    if(event.keyCode === 13){ //código do enter
        event.preventDefault();
        let num_aulas = GetNumAulasAno(input_ano.value);
    }
});

function GetNumAulasAno(ano) {

    const url = '/eventos/' + ano;

    fetch(url,{
        method: 'GET'
    }).then((Response) => {
        let resposta = Response;
        return resposta.json();
    }).then((info) => {
        let num_aulas_dadas;
        info.result[0] === false ? num_aulas_dadas = 0 : num_aulas_dadas = info.result[0].length;
        GetValoresGrafico(num_aulas_dadas,ano);
    });
}

function GetValoresGrafico(num_aulas,ano){
    const url = '/receita/' + ano;
    fetch(url,{
        method: 'GET'
    }).then((Response) => {
        let resposta = Response;
        return resposta.json();
    }).then((info) => {
        let receita = info;
        MontarCampoReceita(Object.values(receita.result),num_aulas);
    });
}


function MontarCampoReceita(receita,aulas_dadas) {

    let receita_total = 0;

    receita.forEach((lucro) => {
        lucro = parseFloat(lucro);
        receita_total += lucro;
    });
    const campo_aulas_dadas = document.querySelector('#aulas-dadas');
    campo_aulas_dadas.textContent = aulas_dadas;

    const campo_receita = document.querySelector('#receita-anual');
    campo_receita.textContent = "R$ " + receita_total.toFixed(2);

    const campo_media_mensal = document.querySelector("#media-mensal");
    let media_mensal = receita_total/receita.length; //receita / num_meses
    campo_media_mensal.textContent = "R$ " + media_mensal.toFixed(2);

    const campo_media_aula = document.querySelector('#media-aula');
    let media;
    receita === 0 || aulas_dadas === 0 ? media = 0 : media = receita_total/aulas_dadas;
    campo_media_aula.textContent = "R$ " + media.toFixed(2);

    CarregarGrafico(receita);

    FadeInDivReceita();

}


function FadeInDivReceita(){
    const div = document.querySelector('#div-receita');
    div.classList.remove('fade-out');
    div.classList.add('fade-in');
    setTimeout(() => {div.classList.remove('fade-in')},1000)
}
