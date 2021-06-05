function Fetch(id,verb) {

        const Form_Data = new FormData();
        let func;
        let url;

        if (verb === "DELETE") {
            Form_Data.append('_method', 'DELETE');
            url = "/admins/" + id;
            func = function (id) {FadeOutLi(id)}
        } else {
            event.preventDefault();
            Form_Data.append('_method', 'POST');
            Form_Data.append('nome', document.getElementsByName('nome')[0].value);
            Form_Data.append('login', document.getElementsByName('login')[0].value);
            Form_Data.append('email', document.getElementsByName('email')[0].value);
            Form_Data.append('senha', document.getElementsByName('senha')[0].value);

            url = "/admins";
            func = function (id) {InformarSucessoAcao()}
        }

        Form_Data.append('_token', document.getElementsByName('_token')[0].value);
        fetch(url, {
            method: 'POST',
            body: Form_Data,
        }).then((Response) => {
            let resposta = Response;
            if (resposta.status === 200) {
                func(id);
            } else {
                InformarFalhaAcao();
            }
        });


}


function FadeOutLi(id){
    const li = document.querySelector('#admin-id-' + id);
    li.classList.add('fade-out');
}

