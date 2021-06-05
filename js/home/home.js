function MostrarPlanosEscondidos(botao) {
    const Row_planos = document.querySelector('#planos-escondidos');

    const Botao_mostrar_menos = document.querySelector('#botao-menos-planos');

    Row_planos.hidden = false;

    botao.hidden = true;

    Botao_mostrar_menos.hidden = false;

    Row_planos.scrollIntoView();
}

function EsconderPlanos(botao) {
    const Row_planos = document.querySelector('#planos-escondidos');
    const Botao_todos_planos = document.querySelector('#botao-todos-os-planos')
    const Row_planos_normais = document.querySelector('#planos-normais');

    Botao_todos_planos.hidden = false;

    Row_planos.hidden = true;
    botao.hidden = true;

    Row_planos_normais.scrollIntoView();
}
