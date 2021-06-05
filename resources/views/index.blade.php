@extends('layoutpadrao')

@section('body')
    <main>
        <section class="section-animacao-scroll pb-5">
            <div class="bd-example">
                <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active dark-overlay">
                            <img src="{{URL::asset('images/carousel/estante.jpeg')}}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block sobreposicao-p sobreposicao-h5">
                                <div class="text-center">
                                    <h5 class="mb-1">Rumos da história</h5>
                                </div>
                                <p>Aulas de história</p>
                            </div>
                        </div>
                        <div class="carousel-item dark-overlay">
                            <img src="{{URL::asset('images/carousel/logo2.jpeg')}}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block sobreposicao-p sobreposicao-h5">
                                <div class="text-center">
                                    <h5 class="mb-1">Rumos da história</h5>
                                </div>
                                <p>Aulas de história</p>
                            </div>
                        </div>
                        <div class="carousel-item dark-overlay">
                            <img src="{{URL::asset('images/carousel/logo.jpeg')}}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block sobreposicao-p sobreposicao-h5">
                                <div class="text-center">
                                    <h5 class="mb-1">Rumos da história</h5>
                                </div>
                                <p>Aulas de história</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-animacao-scroll pb-5" id="biografia">
            <div class="container sobreposicao-h1">
                <h1 class="mb-1">Minha história</h1>
                <hr class="hr-branco">
                <div class="row">
                    <div class="col-sm-12 col-md-6 mb-2">
                        <div class="biografia">
                            <p class="text-justify">
                                   &nbsp Formada em História pela Universidade de São Paulo (USP), instituição na qual faço Mestrado no Programa de Pós-Graduação da Faculdade de Filosofia Letras e Ciências Humanas (FFLCH-USP). Certificada pela Google for Education, para trabalhar com as ferramentas educacionais  da plataforma. <br>
                                   &nbsp Atuo como professora há oito anos, lecionando no Ensino Fundamental II e Médio e em cursos pré-vestibulares. Também ministro aulas particulares e trabalho em colaboração com ONGs educacionais.<br>
                                   &nbsp Acredito que o estudo de História é libertador e tenho como maior objetivo demonstrar que não se trata de uma disciplina “morta” ou “presa ao passado”. Ao contrário, a História está sempre em movimento e, de forma consciente ou não, fazemos parte da trama de relações que a movimenta. 

                            </p>
                        </div>
                        <div class="sobreposicao-p mb-2" id="redes-sociais">
                            <p class="font-weight-bold">Redes sociais</p>
                        </div>
                        <a class="a-branco" href="https://www.instagram.com/alineisa1110/" target="_blank">
                            <i class="fab fa-instagram fa-lg"></i>
                        </a>
                    </div>

                    <div class="col-sm-12 col-md-6 sobreposicao-p">
                        <figure>
                            <img src="{{URL::asset('images/carousel/professoraaline.jpeg')}}" class="img-fluid mx-auto d-block border" alt="Aline, a professora" title="professora aline">
                        </figure>

                        <div class="text-center mt-3">
                            <p>Professora Aline</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-animacao-scroll pb-5" id="relatos">
            <div class="container sobreposicao-h1">
                <h1 class="mb-2">Relatos</h1>
                <hr class="hr-branco">

                <div class="row">
                    <div class="col-sm-12 col-md-6 text-center">
                        <div class="relatos-container sobreposicao-strong visibilidade-on-scroll">
                            <!--<figure class="m-2">
                                <img src="{{URL::asset('images/home/alunos/johndoe.jpg')}}" class="rounded-circle img-thumbnail alunos-satisfeitos" alt="imagem de um aluno satisfeito" title="aluno">
                            </figure>-->
                            <strong>Clébe - ex-aluno (atual estudante Arquitetura e Urbanismo)</strong>
                            <p class="font-italic text-justify quebrar-texto m-2">
                                "A Aline é uma excelente professora. Tive aula com ela no cursinho, e sempre conseguiu fazer com que eu entendesse o conteúdo de forma dinâmica e didática, além de indicar ótimos filmes e séries relacionados.
Também é super atenciosa, e explica super bem os conteúdos, que parecem bem complexos, de forma lúdica, demonstrando total domínio da matéria. Sempre que possível vou indicar a Aline como professora, pois ela é super talentosa e gosta muito do seu trabalho. "
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 text-center">
                        <div class="relatos-container sobreposicao-strong visibilidade-on-scroll">
                            <!--<figure class="m-2">
                                <img src="{{URL::asset('images/home/alunos/johndoe.jpg')}}" class="rounded-circle img-thumbnail alunos-satisfeitos" alt="imagem de um aluno satisfeito" title="aluno">
                            </figure>-->
                            <strong>Nathalia - ex-aluna  (atual aluna de Gestão de Políticas Públicas)</strong>
                            <p class="font-italic text-justify quebrar-texto m-2">
                                "As aulas de história geral da professora Aline me passavam muita tranquilidade, pois entre tantos conteúdos cobrados no vestibular, ela nos direcionava para aqueles com maior importância mas com detalhes.
                                Cada conteúdo era reforçado por questões dissertativas que eram corrigidas por ela com observações relacionadas ao nosso desenvolvimento.
                                Viajei pelo Egito, França, até fiz uma parada no antigo muro de Berlim, com direito a filmes que contavam sobre cada lugar e direito a trilha sonora em questão de horas, e nem sentia a hora passar."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-animacao-scroll pb-5 precos" id="planos-e-precos">
            <div class="container sobreposicao-h1">
                <h1 class="mb-2">Planos</h1>
                <hr class="hr-branco">

                <div class="row sobreposicao-div-fade" id="planos-normais">
                    <div class="col-xs-12 col-sm-12 col-md-4 text-center mb-2">
                        <div class="card div-fade">
                            <figure class="titulo rounded-circle">
                                <img src="{{URL::asset('images/home/planos/carro.png')}}" class="rounded-circle imagem-plano border border-dark" alt="foguete" title="foguete">
                            </figure>
                            <h2 class="mt-2">Básico</h2>
                            <h4 class="mb-2">online</h4>
                            <div class="preco mb-2">
                                <h4><sup>R$</sup>50,00</h4>
                            </div>

                            <div class="beneficios">
                                <p>
                                    <i class="fa fa-check fa-lg" aria-hidden="true"></i> Uma aula online
                                </p>
                                <p>
                                    <i class="fa fa-times fa-lg" aria-hidden="true"></i> Mapas mentais
                                </p>
                            </div>
                            <a href="/login" class="btn btn-outline-dark mb-5 no-wrap">Agendar</a>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-4 text-center mb-2">
                        <div class="card div-fade">
                            <figure class="titulo rounded-circle">
                                <img src="{{URL::asset('images/home/planos/foguete.jpg')}}" class="rounded-circle imagem-plano border border-dark" alt="foguete" title="foguete">
                            </figure>
                            <h2 class="mt-2">Básico</h2>
                            <h4 class="mt-3">Presencial</h4>
                            <div class="preco mb-2">
                                <h5><sup>R$</sup>a consultar</h5>
                            </div>

                            <div class="beneficios">
                                <p>
                                    <i class="fa fa-check fa-lg" aria-hidden="true"></i> Uma aula presencial
                                </p>
                                <p>
                                    <i class="fa fa-times fa-lg" aria-hidden="true"></i> Mapas mentais
                                </p>
                            </div>
                            <a href="/login" class="btn btn-outline-dark mb-5 no-wrap">Consultar</a>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-4 text-center mb-2">
                        <div class="card div-fade">
                            <figure class="titulo rounded-circle">
                                <img src="{{URL::asset('images/home/planos/foguete.jpg')}}" class="rounded-circle imagem-plano border border-dark" alt="foguete" title="foguete">
                            </figure>
                            <h2 class="mt-2 mb-5">Premium</h2>
                            <div class="preco mb-2">
                                <h4><sup>R$</sup>350,00</h4>
                            </div>

                            <div class="beneficios">
                                <p>
                                    <i class="fa fa-check fa-lg" aria-hidden="true"></i> quatro aulas(mensal)
                                </p>
                                <p>
                                    <i class="fa fa-check fa-lg" aria-hidden="true"></i> Mapas mentais
                                </p>
                            </div>
                            <a href="/login" class="btn btn-outline-dark mb-5 no-wrap">Consultar</a>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <div class="zoom" id="botao-todos-os-planos" onclick="MostrarPlanosEscondidos(this)">
                        <i class="fas fa-arrow-down"></i> Ver todos os planos(+ 2)
                    </div>
                </div>

                <div class="row sobreposicao-div-fade" hidden="true" id="planos-escondidos">
                    <div class="col-xs-12 col-sm-12 col-md-4 text-center mb-2">
                        <div class="card div-fade">
                            <figure class="titulo rounded-circle">
                                <img src="{{URL::asset('images/home/planos/foguete.jpg')}}" class="rounded-circle imagem-plano border border-dark" alt="foguete" title="foguete">
                            </figure>
                            <h2 class="mt-2 mb-5">Premium</h2>
                            <div class="preco mb-2">
                                <h4><sup>R$</sup>350,00</h4>
                            </div>

                            <div class="beneficios">
                                <p>
                                    <i class="fa fa-check fa-lg" aria-hidden="true"></i> quatro aulas(mensal)
                                </p>
                                <p>
                                    <i class="fa fa-check fa-lg" aria-hidden="true"></i> Mapas mentais
                                </p>
                                <p>
                                    <i class="fa fa-check fa-lg" aria-hidden="true"></i> Consultoria
                                </p>
                            </div>
                            <a href="/precomap" class="btn btn-outline-dark mb-5 no-wrap">Consultar</a>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-4 text-center mb-2">
                        <div class="card div-fade">
                            <figure class="titulo rounded-circle">
                                <img src="{{URL::asset('images/home/planos/foguete.jpg')}}" class="rounded-circle imagem-plano border border-dark" alt="foguete" title="foguete">
                            </figure>
                            <h2 class="mt-2 mb-5">Premium</h2>
                            <div class="preco mb-2">
                                <h4><sup>R$</sup>350,00</h4>
                            </div>

                            <div class="beneficios">
                                <p>
                                    <i class="fa fa-check fa-lg" aria-hidden="true"></i> quatro aulas(mensal)
                                </p>
                                <p>
                                    <i class="fa fa-check fa-lg" aria-hidden="true"></i> Mapas mentais
                                </p>
                                <p>
                                    <i class="fa fa-check fa-lg" aria-hidden="true"></i> Consultoria
                                </p>
                            </div>
                            <a href="/precomap" class="btn btn-outline-dark mb-5 no-wrap">Consultar</a>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <div class="zoom" id="botao-menos-planos" onclick="EsconderPlanos(this)" hidden>
                        <i class="fas fa-arrow-up"></i> Mostrar menos
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="js/home/home.js"></script>
@endsection
