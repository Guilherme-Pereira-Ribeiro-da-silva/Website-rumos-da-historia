
function GetToken(dia,mes,ano,hora,periodo,conteudo_especifico,$tipo_aula) {
    document.querySelector('#loader').classList.remove('esconder-div');
    const formdata = new FormData();
    formdata.append('_token',document.getElementsByName('_token')[0].value);
    formdata.append('dia',dia);
    formdata.append('mes',mes);
    formdata.append('ano',ano);
    formdata.append('hora',hora);
    formdata.append('tipo_aula',$tipo_aula);
    formdata.append('area-historia',periodo);
    formdata.append('conteudo-especifico',conteudo_especifico);

    const url = '/pagamento';

    fetch(url,{
        method: "POST",
        body: formdata
    }).then((Response) => {

        if(Response.status === 200){
            return Response.json();
        }else{
            AbreModal(null,null);
        }

    }).then((token) => {
        if(token !== undefined){
            token = token.result[0];
            AtribuirValorToken(token);
        }
    })
}

function AtribuirValorToken(token){
    const input_token = document.querySelector('#pagseguro_token');
    input_token.value = token;

    SubmitForm();
}

function SubmitForm(){
    document.querySelector('#FormPagamento').submit();
}
