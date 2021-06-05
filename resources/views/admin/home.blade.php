@extends('layoutadmin')
@section('body')
    <section class="section-animacao-scroll overflow-x-hidden">
        <div class="container sobreposicao-h1">
            <div class="alert alert-light margem-para-escapar-nav">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="text-left">
                            Home/dashboard
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-right">
                            Olá,{{Session::get('admin')}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row sobreposicao-div-fade">
                <div class="col-sm-12 col-md-4 d-flex justify-content-center mb-2 zoom-on-hover">
                    <div class="div-admin-card branco div-fade">
                        <h4 class="mr-3 ml-2 mb-0 text-dark">{{$numero_admins}} admins <i class="fas fa-comments fa-lg mt-3"></i></h4>
                        <hr>
                        <a href="#admins" class="btn btn-outline-dark mb-2 max-width-80">Ver detalhes</a>
                     </div>
                </div>

                <div class="col-sm-12 col-md-4 d-flex justify-content-center mb-2 zoom-on-hover">
                    <div class="div-admin-card branco text-light div-fade">
                        <h4 class="mr-3 ml-2 mb-0 text-dark">{{$alunos_cadastrados}} alunos <i class="fas fa-user-graduate fa-lg mt-3"></i></h4>
                        <hr>
                        <a href="#alunos" class="btn btn-outline-dark mb-2 max-width-80">Ver detalhes</a>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 d-flex justify-content-center mb-2 zoom-on-hover">
                    <div class="div-admin-card branco text-light div-fade">
                        <h4 class="mr-3 ml-2 mb-0 text-dark">{{$numero_aulas}} Aulas <i class="fas fa-school fa-lg mt-3"></i></h4>
                        <hr>
                        <a href="#calendario-e-agenda"  class="btn btn-outline-dark mb-2 max-width-80">Ver detalhes</a>
                    </div>
                </div>
            </div>

            <h1 class="mt-5" id="receita">Receita</h1>
            <hr class="hr-branco">

            <div class="row sobreposicao-div-fade-lateral" id="div-receita">
                <div class="col-sm-12 col-md-6 mb-4 sobreposicao-h5">
                    <h5 class="mb-2">Ano <input id="ano-receita" type="number" value="{{$ano}}"></h5>
                    <div id="linechart_material" class="line_chart"></div>
                </div>

                <div class="col-sm-12 col-md-6 mb-2">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-2">
                            <div class="div-card-lucro branco pt-2 pb-2 h-100 zoom-on-hover div-fade">
                                <div class="row">
                                    <div class="col-sm-2">
                                      <div class="rounded-circle max-width-10 vermelho-opaco px-4 py-2 ml-1  d-flex justify-content-center">
                                              <i class="fas fa-dollar-sign fa-2x"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-10 text-dark sobreposicao-h5 sobreposicao-p">
                                        <p class="h5 mb-2 ml-3">Receita Anual</p>
                                        <h5 class="ml-3" id="receita-anual">R$ {{number_format(array_sum($elements->original["result"]),2)}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 mb-2">
                            <div class="div-card-lucro branco text-dark sobreposicao-p h-100 zoom-on-hover div-fade">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <i class="fab fa-medium mt-1 fa-3x  ml-2 text-warning" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-sm-10">
                                        <p class="ml-3 mb-1 mt-1 font-weight-bold">Média mensal</p>
                                        <p class="ml-3 mb-1 font-weight-bold" id="media-mensal">R$ {{number_format(array_sum($elements->original["result"])/count($elements->original["result"]),2)}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-2">
                            <div class="div-card-lucro branco h-100 zoom-on-hover div-fade">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="rounded-circle max-width-10 wheat px-4 py-3 m-3 d-flex justify-content-center">
                                            <i class="fas fa-chalkboard-teacher fa-lg"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-10 text-dark sobreposicao-h5 sobreposicao-p">
                                       <div class="w-100 h-50 d-flex justify-content-center">
                                            <p class="mb-2 ml-3 mt-1 font-weight-bold">Aulas dadas</p>
                                        </div>

                                        <div class="w-100 h-50 d-flex justify-content-center">
                                            <h5 class="ml-3 mb-1 d-flex" id="aulas-dadas">{{$aulas_dadas}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 mb-2">
                            <div class="div-card-lucro branco h-100 zoom-on-hover div-fade">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="rounded-circle max-width-10 laranja px-4 py-3 mt-2 ml-2  d-flex justify-content-center">
                                            <i class="fas fa-wallet fa-lg"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-10 text-dark sobreposicao-h5 sobreposicao-p">
                                        <div class="w-100 h-50 d-flex justify-content-center">
                                            <p class=" font-weight-bold mt-1">Média por aula</p>
                                        </div>

                                        <div class="w-175 h-50 d-flex justify-content-center">
                                            <h5 class="ml-1 mb-1 mt-1 d-flex" id="media-aula">R$ {{$aulas_dadas > 0 ? number_format(array_sum($elements->original["result"])/$aulas_dadas,2) : 0}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h1 class="mt-5">Usuários do sistema</h1>
            <hr class="hr-branco">

            <div class="row mb-5" id="alunos">
                <div class="col-sm-12 col-md-6 sobreposicao-p">
                    <p class="h4">Alunos</p>
                    <hr class="hr-branco">

                    <ul id="ul-usuarios">

                    </ul>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center" id="ul-paginacao-alunos">

                        </ul>
                    </nav>
                </div>

                <div class="col-sm-12 col-md-6 sobreposicao-p" id="admins">
                    <p class="h4">Administradores</p>
                    <hr class="hr-branco">

                    <ul id="ul-admins">

                    </ul>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center" id="ul-paginacao-admins">

                        </ul>
                    </nav>
                </div>
            </div>

            <h1 id="calendario-e-agenda">Agenda</h1>
            <hr class="hr-branco">

            <div class="container-calendario mb-5">
                <div class="calendario" id="calendario">
                    <div class="mes">
                        <i class="fas fa-angle-left" id="mes-anterior"></i>
                        <div class="data">
                            <h2 id="mes-display"></h2>
                            <p id="data-atual-display"></p>
                        </div>
                        <i class="fas fa-angle-right" id="mes-proximo"></i>
                    </div>
                    <div class="semana">
                        <div>Dom</div>
                        <div>Seg</div>
                        <div>Ter</div>
                        <div>Qua</div>
                        <div>Qui</div>
                        <div>Sex</div>
                        <div>Sab</div>
                    </div>
                    <div class="dias">

                    </div>
                </div>

                <div class="h-50 w-75 agenda d-none" id="agenda">
                    <h5 class="text-dark p-2" id="titulo-agenda"></h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Horário
                                    </th>
                                    <th>
                                        Atividade
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        14:00
                                    </td>
                                    <td id="duas-horas">
                                        Vago
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                        15:00
                                    </td>
                                    <td id="tres-horas">
                                        Vago
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        16:00
                                    </td>
                                    <td id="quatro-horas">
                                        Vago
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        17:00
                                    </td>
                                    <td id="cinco-horas">
                                        Vago
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        18:00
                                    </td>
                                    <td id="seis-horas">
                                        Vago
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        19:00
                                    </td>
                                    <td id="sete-horas">
                                        Vago
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="w-100 d-flex justify-content-end">
                        <button class="btn btn-outline-dark m-2" onclick="fecharAgenda()">fechar</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal text-dark div-fade animacao-modal" id="ModalMultiUso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header w-100" id="cabecalho-modal">

                        <div class="row" id="row-modal-header">

                            <div class="col-sm-12 d-flex justify-content-center">
                                <figure class="w-25">
                                    <img class="img-alunos-admins" id="img-modal">
                                </figure>
                            </div>

                            <div class="col-sm-12 d-flex justify-content-center">
                                <h4 class="mt-2 ml-0" id="nome-modal"></h4>
                            </div>

                        </div>
                    </div>
                    <div class="modal-body" id="modal-body">
                        <div class="row" id="modal-body-row">

                        </div>
                        <form method="POST" action="/admins" hidden id="form-criar-admin">
                            @csrf
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" class="form-control" id="nome" aria-describedby="nome" placeholder="Escreva o nome">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Escreva o email">
                            </div>
                            <div class="form-group">
                                <label for="login">Login</label>
                                <input type="text" name="login" class="form-control" id="login" placeholder="Escreva o login">
                            </div>
                            <div class="form-group">
                                <label for="input-senha">Senha</label>
                                <input type="password" name="senha" class="form-control" id="input-senha" placeholder="Escreva a senha">
                            </div>
                            <button type="submit" id="input-submit" onclick="Fetch(null,'POST')" class="btn btn-outline-dark mb-3">Cadastrar</button>
                            <span id="span-erros">

                            </span>
                        </form>
                    </div>
                    <div class="modal-footer" id="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <form hidden>
        @csrf
    </form>
@endsection

@section('scripts')
    <script>
        let elements = '<?php echo json_encode($elements->original['result'])?>';
    </script>
    <script src="js/admin/home/listagens_ul.js"></script>
    <script src="js/admin/home/monta_modal.js"></script>
    <script src="js/admin/home/home_admin.js"></script>
    <script src="js/cadastro/cadastro.js"></script>
    <script src="js/calendario.js"></script>
    <script src="js/admin/home/agendadiariaadmin.js"></script>
    <script src="js/admin/home/receita.js"></script>
    <script src="js/admin/graficoarea.js"></script>
@endsection
