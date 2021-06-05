let results = {
    "home": "/",
    "biografia": "/#biografia",
    "planos": "/#planos-e-precos",
    "relatos": "#relatos",
    "login": "/login",
    "registro": "/registro",
    "redes": "/#redes-sociais"
}

const searchbox = document.querySelector("#searchbox");
const ul_searchbox = document.querySelector("#ul-results-searchbox");
const button = document.querySelector("#button");
const searchbox_modal = document.querySelector("#searchbox-modal");


searchbox.addEventListener("input",() => {
    button.click();
    ul_searchbox.innerHTML = "";
});


searchbox_modal.addEventListener("input",() => {
    ul_searchbox.innerHTML = "";
    let input = document.querySelector("#searchbox-modal").value.toLowerCase();
    for(let i in results){
        if(i.match(input)){
            CreateLI(i);
        }
        input.length === 0 ? ul_searchbox.innerHTML = "" : "";
    }
    ul_searchbox.children.length === 0 ? CreateLI("Nenhum resultado encontrado") : "";
});

function CreateLI(content) {
    let li = document.createElement("li");
    li.classList.add("zoom");
    li.classList.add("cursor-pointer");
    li.classList.add("no-list-style");
    li.classList.add("mb-2");
    li.setAttribute("data-dismiss","modal");
    li.textContent = content;
    li.onclick = () => {
        Href(results[content]);
    }

    const i = document.createElement("i");
    i.classList.add("fas");
    i.classList.add("fa-search");
    i.classList.add("ml-2");
    li.appendChild(i);

    ul_searchbox.appendChild(li);
}

function Href(href) {
    if(href !== undefined && href !== null){
        window.location.href = href;
    }
}
