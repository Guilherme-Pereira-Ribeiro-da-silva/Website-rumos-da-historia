CarregarInfo(1,5,"admin");
CarregarInfo(1,5,"alunos");
function CarregarInfo(page, perpage,usertype) {
    ApagarDadosUleModal(usertype);

    let url;

    if(usertype === "admin"){
        url = "/admins?page=" + page + "&per_page=" + perpage;
    }else{
        url = "/alunos?page=" + page + "&per_page=" + perpage;
    }

    fetch(url,{
        method: 'GET',
    }).then((response) => {

        let resposta = response; //Json response só aceita ser usada uma vez

        if(resposta.status !== 404 && resposta.status !== 500){
            return resposta.json();
        }else{
            return false;
        }
    }).then((resposta) => {
        if(resposta !== false) {

            let totalpaginas = Math.ceil(resposta.count/5); //5 elementos por página
            CalcularPaginacao(1,5,totalpaginas,usertype)

            resposta.result.forEach((info) => {
                CriarLi(info,usertype);
            });
        }else{
            InformarErroLista();
        }
    });
}

function InformarErroLista(usertype) {

    let ul;
    const li = document.createElement("li");
    const h5 = document.createElement("h5");


    if(usertype === "admin"){
        ul = document.querySelector("#ul-admins");
        li.classList.add("li-admins");
        h5.textContent = "Não existem administradores nesta página";
    }else{
        ul = document.querySelector("#ul-usuarios");
        li.classList.add("li-usuarios");
        h5.textContent = "Não existem alunos nesta página";
    }

    ul.appendChild(li);

    li.appendChild(h5);
}

function CriarLi(info,usertype){
    let ul;
    const li = document.createElement('li');
    if(usertype === "admin"){
        ul = document.querySelector("#ul-admins");
        li.setAttribute('id','admin-id-'+ info["id"]);
        li.classList.add("li-admins");
        li.classList.add('mb-4');
    }else{
        ul = document.querySelector("#ul-usuarios");
        li.classList.add("li-usuarios");
        li.classList.add('mb-4');
    }

    ul.appendChild(li);

    CriarRow(li,info,usertype);
}

function CriarRow(li,info,usertype) {
    const div_row = document.createElement('div');
    div_row.classList.add('row');

    li.appendChild(div_row);

    CriarColSm2(div_row,info,usertype);
    CriarColSm10(div_row,info,usertype);
}

function CriarColSm2(row,info,usertype) {
    const div_col_2 = document.createElement('div');
    div_col_2.classList.add('col-sm-2');
    div_col_2.classList.add('col-2');


    row.appendChild(div_col_2);
    DetalhesColsm2(div_col_2,info,usertype);
}

function DetalhesColsm2(div_col_2,info,usertype) {
    const figure = document.createElement('figure');
    let src;
    const img = document.createElement('img');


    img.classList.add('img-alunos-admins');
    img.classList.add('zoom-on-hover');
    img.classList.add('animacao-alunos');
    img.setAttribute('alt',info["nome"]);
    img.setAttribute('title',info["nome"]);
    img.setAttribute('id','img-'+ usertype +'-id-' + info["id"]);
    img.onclick = function (){MontaModalHeader(info)};
    img.setAttribute('data-toggle','modal');
    img.setAttribute('data-target','#ModalMultiUso');



    if(info["foto"] === null || info["foto"] === undefined || !info["foto"].length > 0){
        src = "/images/"+ usertype +"/semfoto.png";
    }else{
        src = info['foto'];
    }

    img.setAttribute('src',src);

    div_col_2.appendChild(figure);
    figure.appendChild(img);
}

function CriarColSm10(row,info,usertype) {
    const div_col_10 = document.createElement('div');
    div_col_10.classList.add('col-sm-10');
    div_col_10.classList.add('col-10');
    div_col_10.classList.add('animacao-alunos');

    row.appendChild(div_col_10,info);

    CriarStrong(div_col_10,info,usertype);
}

function CriarStrong(ColSm10,info,usertype) {
    const strong = document.createElement('strong');
    strong.textContent = info["nome"];
    const strong2 = document.createElement('strong');
    strong2.classList.add('ml-5');


    ColSm10.appendChild(strong);

    if(usertype === "admin"){
        CriarAeIAdmin(strong2,info);
    }else{
        strong2.textContent = info["email"];
    }

    ColSm10.appendChild(strong2);
}

function CriarAeIAdmin(strong,admin){
    const a = document.createElement('a');
    a.classList.add('a-branco');

    const i =document.createElement('i');
    i.classList.add('fas');
    i.classList.add('fa-trash');
    i.classList.add('i-trash');
    i.setAttribute('title','apagar ' + admin['nome'] + ' da lista de admins');
    i.setAttribute('data-toggle','modal');
    i.setAttribute('data-target','#ModalMultiUso');
    i.onclick = function (){MontaModalHeader(admin,1)};

    const i2 =document.createElement('i');
    i2.classList.add('fas');
    i2.classList.add('fa-plus');
    i2.classList.add('i-plus');
    i2.classList.add('ml-1');
    i2.setAttribute('title','adicionar na lista de admins');
    i2.setAttribute('data-toggle','modal');
    i2.setAttribute('data-target','#ModalMultiUso');
    i2.onclick = function (){MontaModalCreateAdmin(admin,1)};

    a.appendChild(i);
    a.appendChild(i2);

    strong.appendChild(a);

}

function ApagarDadosUleModal(usertype) {
    let ul;

    if(usertype === "admin"){
        ul = document.querySelector('#ul-admins');
    }else{
        ul = document.querySelector('#ul-usuarios');
    }

    ul.innerHTML = "";

    const form = document.querySelector('#form-criar-admin');
    form.hidden = true;
}

function CalcularPaginacao(page,perpage,totalpages,usertype){

    if(totalpages === null || totalpages === undefined){
        CarregarInfo(page,perpage,usertype);
    }

    page = parseInt(page);

    let ul;

    if(usertype === "admin"){
        ul = document.querySelector("#ul-paginacao-admins");
    }else{
        ul = document.querySelector("#ul-paginacao-alunos");
    }

    ul.innerHTML = "";


    for(let pag_ant = page - 2; pag_ant <= page - 1; pag_ant++)
    {
        if(pag_ant >= 1)
        {
            CriarLiPaginacao(ul,pag_ant,usertype);
        }
    }

    CriarLiPaginacao(ul,page,usertype);

    for(let pag_dep = page + 1; pag_dep <= page + 2; pag_dep++)
    {
        if(pag_dep <= totalpages)
        {
            CriarLiPaginacao(ul,pag_dep,usertype);
        }
    }
}

function CriarLiPaginacao(ul,numero,usertype) {
    const li = document.createElement('li');
    li.classList.add("page-item");

    ul.appendChild(li);

    CriarApaginacao(li,numero,usertype);
}

function CriarApaginacao(li,numeropag,usertype){
    const a = document.createElement("a");
    a.classList.add("page-link");
    a.classList.add("sem-fundo");
    a.classList.add('zoom-on-hover');

    if(usertype === "admin") {
        a.setAttribute("href","#admins");
        a.onclick = function () {
            CalcularPaginacao(numeropag, 5, null, 'admin')
        };
    }else{
        a.setAttribute("href","#alunos");
        a.onclick = function () {
            CalcularPaginacao(numeropag, 5, null, 'alunos')
        };    }
    a.textContent = numeropag;

    li.appendChild(a);
}
