function mostrarTimeline(hora,data){

    const titulo_modal = document.querySelector('#staticBackdropLabel');
    titulo_modal.textContent = "Escolha um período histórico";
    const modal_body = document.querySelector('#modal-body');
    modal_body.innerHTML = "";

    const div = document.createElement('div');

    CreateUl(data,hora,div);

    modal_body.appendChild(div);
}

function CreateUl(data,hora,div){
    const ul = document.createElement("ul");
    ul.classList.add('timeline');

    CreateLi(ul,"/images/alunos/timeline/pre-historia.png","Pré-história","","(começo dos tempos a 3500 a.C)",hora,data);
    CreateLi(ul,"/images/alunos/timeline/historia-antiga.png","Idade Antiga","","",hora,data);
    CreateLi(ul,"/images/alunos/timeline/idade-media.png","Idade Média","","",hora,data);
    CreateLi(ul,"/images/alunos/timeline/idade-moderna.png","Idade Moderna","","",hora,data);
    CreateLi(ul,"/images/alunos/timeline/idade-contemporanea.png","Idade Contemporânea","","",hora,data);

    div.appendChild(ul);


}

function CreateLi(ul,imgpath,textop,text,periodo,hora,data){

    const li = document.createElement('li');
    li.classList.add("d-inline-block");
    li.classList.add("margem-5");
    li.classList.add("circulo-periodo-historico");

    const div = document.createElement("div");
    div.classList.add("rounded");
    div.classList.add("rounded-circle");

    const img = document.createElement('img');
    img.setAttribute("src",imgpath);
    img.setAttribute("alt",textop);
    img.setAttribute("title",textop);
    img.classList.add("img-timeline");
    img.classList.add("cursor-pointer");
    img.onclick = () => {
        MontarTextArea(textop,text,periodo,hora,data);
    };

    div.appendChild(img);

    li.appendChild(div);
    ul.appendChild(li);
}

function MontarTextArea(textop,text,periodo,hora,data) {
    const modal_body = document.querySelector("#modal-body");
    const div_detalhe = document.querySelector("#div-detalhes");

    if(div_detalhe !== undefined && div_detalhe !== null){
        div_detalhe.parentElement.children[1].remove();
    }
    const div_detalhes = document.createElement("div");
    div_detalhes.setAttribute("id","div-detalhes");

    const div_resumo = document.createElement("div");
    div_resumo.classList.add("fade-in-invertido");
    div_resumo.classList.add("mb-4");
    div_resumo.classList.add("mt-2");
    let  div_resumo_html = "<p class='w-100 mb-2' id='area-historia'><b>"+ textop + periodo+"</b></p>";
    div_resumo_html += "lorem ipsum";
    div_resumo_html += "<hr class='text-dark'>";
    div_resumo.innerHTML = div_resumo_html;

    const div = document.createElement("div");
    div.setAttribute("id","div-textbox");
    div.classList.add("fade-in");
    let div_html = "<p class='w-100'>Área escolhida: "+ textop +"</p>";
    div_html += "<textarea class='input-group' id='textarea-area-especifica'>Digite aqui o que você deseja estudar especificamente</textarea>";
    div_html += "<button class='btn btn-outline-dark mt-2 btn-block' onclick='MostrarPlanos("+ hora + "," + data[0] + "," + data[1] + "," + data[2] + "," + JSON.stringify(textop) + ")'>Confirmar</button>";

    div.innerHTML = div_html;

    div_detalhes.appendChild(div_resumo);
    div_detalhes.appendChild(div);
    modal_body.appendChild(div_detalhes);
}
