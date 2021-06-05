@extends('layoutlogado')

@section('body')
    <section class="section-animacao-scroll overflow-x-hidden">
        <div class="container sobreposicao-h1 mb-5">
            <div class="alert alert-light margem-para-escapar-nav">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="text-left">
                            Home/dashboard
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-right">
                            Olá,{{Session::get('aluno')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-animacao-scroll overflow-x-hidden">
        <div class="container sobreposicao-h1 mb-5">
            <h1 id="minhas-aulas">Minhas Aulas</h1>
            <hr class="hr-branco">
            <div class="row">
                <div class="col-sm-2 d-flex align-items-center justify-content-center mb-3">
                    <div class="rounded-circle zoom-on-hover max-width-10 laranja px-4 py-2 ml-1  d-flex justify-content-center cursor-pointer" id="botao-anterior">
                        <i class="fas fa-arrow-left fa-2x" onclick="Prev()"></i>
                    </div>
                </div>

                <div class="col-sm-8 mt-2">
                    <div class="row" id="row-cards" page="1" perpage="3">
                        <div class="col-md-4 col-sm-12 mb-3 d-flex justify-content-center sobreposicao-div-fade">
                            <div class="card div-fade p-1 cursor-pointer" id="card-0">
                                <b>ID:</b><p id="id-0"></p>
                                <b>Nome:</b><p id="nome-0"></p>
                                <b>Data:</b><p id="data-0"></p>
                                <b>Hora:</b><p id="hora-0"></p>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12 mb-3 d-flex justify-content-center sobreposicao-div-fade">
                            <div class="card div-fade p-1 cursor-pointer" id="card-1">
                                <b>ID:</b><p id="id-1"></p>
                                <b>Nome:</b><p id="nome-1"></p>
                                <b>Data:</b><p id="data-1"></p>
                                <b>Hora:</b><p id="hora-1"></p>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12 mb-3 d-flex justify-content-center sobreposicao-div-fade">
                            <div class="card div-fade p-1 cursor-pointer" id="card-2">
                                <b>ID:</b><p id="id-2"></p>
                                <b>Nome:</b><p id="nome-2"></p>
                                <b>Data:</b><p id="data-2"></p>
                                <b>Hora:</b><p id="hora-2"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-2 d-flex align-items-center justify-content-center">
                    <div class="rounded-circle zoom-on-hover max-width-10 laranja px-4 py-2 ml-1  d-flex justify-content-center cursor-pointer" id="botao-proximo">
                        <i class="fas fa-arrow-right fa-2x" onclick="Next()"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-animacao-scroll overflow-x-hidden">
        <div class="container sobreposicao-h1 mt-5">
            <h1 id="agendamento">Agendar Aula</h1>
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
                                <td id="duas-horas" class="verde cursor-pointer" onclick="MostrarModal(14)">
                                    <b>Agendar este horário</b>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    15:00
                                </td>
                                <td id="tres-horas" class="verde cursor-pointer" onclick="MostrarModal(15)">
                                    <b>Agendar este horário</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    16:00
                                </td>
                                <td id="quatro-horas" class="verde cursor-pointer"  onclick="MostrarModal(16)">
                                    <b>Agendar este horário</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    17:00
                                </td>
                                <td id="cinco-horas" class="verde cursor-pointer"  onclick="MostrarModal(17)">
                                    <b>Agendar este horário</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    18:00
                                </td>
                                <td id="seis-horas" class="verde cursor-pointer"  onclick="MostrarModal(18)">
                                    <b>Agendar este horário</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    19:00
                                </td>
                                <td id="sete-horas" class="verde cursor-pointer"  onclick="MostrarModal(19)">
                                    <b>Agendar este horário</b>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="w-100 d-flex justify-content-end">
                        <button class="btn btn-outline-dark m-2 zoom-on-hover" id="btn-fechar" onclick="fecharAgenda()">fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-animacao-scroll overflow-x-hidden">
        <div class="container sobreposicao-h1 mt-5">
            <h1>Meus dados</h1>
            <hr class="hr-branco mb-2">
            <div class="table table-responsive">
                <table class="table table-striped bg-white">
                    <tbody>
                    <tr>
                        <td>
                            <b>Nome</b>
                        </td>
                        <td class="text-center" id="td-nome">
                            ******
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Email</b>
                        </td>
                        <td class="text-center" id="td-email">
                            ******
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Endereço</b>
                        </td>
                        <td class="text-center" id="td-endereco">
                            ******
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Login</b>
                        </td>
                        <td class="text-center" id="td-login">
                            ******
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="text-center" colspan="2">
                            <button id="button-editar" class="btn btn-outline-dark" onclick="PedirSenha()">Editar informações</button>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>

    <section>
        <button id="button" hidden></button>
        <!-- Modal -->
        <div class="modal animacao-modal" id="ModalPrecos" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    </div>
                    <div class="modal-body mt-3" id="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark zoom-on-hover" data-dismiss="modal" id="button-cancelar">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <form hidden name="FormPagamento" id="FormPagamento" action="https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html" method="get">
        @csrf
        <input type="text" name="code" id="pagseguro_token" value="" />
        <input type="hidden" name="iot" value="button" />
        <input type="hidden" id="id" value="">
    </form>
@endsection

@section('scripts')
    <script src="{{URL::asset('js/calendario.js')}}"></script>
    <script src="{{URL::asset('js/alunos/agenda_diaria.js')}}"></script>
    <script src="{{URL::asset('js/alunos/planos.js')}}"></script>
    <script src="{{URL::asset('js/pagamento/fetch_token.js')}}"></script>
    <script src="{{URL::asset('js/alunos/timeline.js')}}"></script>
    <script src="{{URL::asset('js/alunos/homealunos.js')}}"></script>
@endsection
