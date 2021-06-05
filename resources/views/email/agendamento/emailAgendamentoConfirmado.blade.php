<html lang="pt-br">
<head>
    <title>
        Email da professora Aline
    </title>
</head>
    <body>
        <div style="font-family: Consolas,serif;">
            <p>
                Olá,{{$nome_aluno}}.Nós, do rumos da história, ficamos felizes em informar que o seu pedido de agendamento
                de {{$tipo_aula}} no dia {{$data}} das {{$hora}} às {{$hora + 1}} horas foi confirmado!
            </p>
            @if($tipo_aula === "aula online")
                <p>
                    O encontro será realizado por meio de uma reunião no aplicativo Zoom.
                </p>
                <p>
                    Para acessa-la, você pode usar <a style="text-decoration: none" href="{{$url}}">este link</a> no horário marcado.
                </p>
                <p>
                    A professora estará lhe esperando no horário e dia combinado!
                </p>
            @else
                <p>
                    O encontro será realizado presencialmente.
                </p>
                <p>
                    A professora lhe visitará no dia e hora combinados. Não esqueça de sempre deixar suas informações atualizadas!
                </p>
            @endif
            <p style="margin-top: 30px">
              muito obrigado e boa aula!
            </p>
        </div>
    </body>
</html>
