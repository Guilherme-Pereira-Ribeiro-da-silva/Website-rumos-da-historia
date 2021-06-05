<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aulas sobre todos os conteúdos da história humana ao seu tempo e sua necessidade">
    <meta name="keywords" content="Professora, história, Aline">
    <meta name="author" content="Guilherme Pereira Ribeiro da Silva">
    <link rel="shortcut icon" type="image/x-icon" href="/images/logo.ico"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <link href="{{URL::asset('/css/main.css')}}" rel="stylesheet" type="text/css">

    <title>Rumos da História</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <img src='/images/logoloja.ico' class='logo'>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link " href="/admin">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#admins">Administradores</a>
                        <a class="dropdown-item" href="#calendario-e-agenda">Agenda</a>
                        <a class="dropdown-item" href="#">Perguntas dos alunos</a>
                        <a class="dropdown-item" href="#receita">Receita</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/sair">Sair</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
@yield('body')
<footer class="pt-2 pb-2">
    <div class="container">
        <hr class="hr-branco">
        <div class="row">
            <div class="col-sm-6">
                <h3>Sobre nós</h3>
                <p class="text-justify">
O estudo da História nos ajuda a compreender os desdobramentos do passado no presente. Para que o processo de aprendizagem da disciplina seja significativo e libertador, recorremos a diálogos, elaboração de mapas conceituais, realização de exercícios, jogos, músicas e vídeos.                 </p>
            </div>

            <div class="col-sm-3 ml-2">
                <h5>Política do site</h5>
                <p class="text-justify">
                    <a class="a-branco" href="#">Política de uso</a>
                </p>
            </div>
        </div>
        <hr class="hr-branco">

        <div class="row">
            <div class="col-sm-6">
                <div class="text-left">
                     {{"Copyright@".date("Y")}} Todos os direitos reservados
                </div>
            </div>
            <div class="col-sm-6">
                <div class="text-right">
                    Desenvolvido por
                    <a class="a-branco" href="https://www.linkedin.com/in/guilherme-pereira-5097b31a2/" target="_blank">
                        Guilherme Pereira
                    </a>
                </div>
            </div>
            <div class="col-sm-12 text-right">
                Ícones da timeline feitos por <a class="a-branco" href="https://www.flaticon.com/br/autores/freepik" title="Freepik" target="_blank">Freepik</a> de <a class="a-branco" href="https://www.flaticon.com/br/" title="Flaticon" target="_blank"> www.flaticon.com</a>
            </div>
        </div>
    </div>
</footer>

<div class="loader" id="loader">
    <div class="spinner-border text-light" role="status">
    </div>
</div>

<script src="js/scroll-out.js"></script>
<script src="js/main.js"></script>
<script>
    ScrollOut({
        targets: 'div,li,h1,h2,h3,h4,h5,h6,p,strong,.relatos-container'
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/scrolltosmooth/dist/scrolltosmooth.min.js"></script>
<script src="js/smooth_scroll.js"></script>
@yield('scripts')
</body>
</html>
