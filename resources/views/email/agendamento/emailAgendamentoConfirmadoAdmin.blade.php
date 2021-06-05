<html lang="pt-br">
<head>
    <title>
        Email da professora Aline
    </title>
</head>
    <body>
        <div style="font-family: Consolas,serif;">
            <p>
                Olá,Adminstrador.O aluno {{$nome_aluno}}, o qual agendou uma {{$tipo_aula}} no dia {{$data}} das {{$hora}} às {{$hora + 1}} horas,acaba de ter seu pagamento confirmado!
            </p>
            @if($tipo_aula === "aula online")
                <p>
                    O encontro será realizado por meio de uma reunião no aplicativo Zoom, a qual já foi agendada.
                </p>
                <p>
                    Para acessa-la, você pode usar <a style="text-decoration: none" href="{{$url}}">este link</a> no horário marcado.
                </p>
            @else
                <p>
                    O encontro será realizado Presencialmente.
                </p>
                <p>
                    Lembre-se de sempre verificar se nenhuma informação foi atualizada.
                </p>
            @endif
            
            <p>
                Não o deixe esperando!
            </p>
            <p style="margin-top: 30px">
              muito obrigado e um ótimo dia!
            </p>
        </div>
    </body>
</html>
