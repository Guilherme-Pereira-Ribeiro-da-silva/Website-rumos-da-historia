@extends('layoutpadrao')

@section('body')
    <section>
        <div class="login-e-cadastro d-flex align-items-center justify-content-center">
            <div class="row">
                <div class="col-sm-12">
                    <div class="div-center rounded">
                        <div class="login-content">
                            <form>
                                @csrf
                                <img src="images/logincadastro/fotocadastro.png" alt="foto-cadastro" title="foto cadastro">
                                <h4>Cadastro</h4>
                                <div class="input-div one">
                                    <div class="i">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="div">
                                        <h5>Login</h5>
                                        <input type="text" name="login" class="input" required>
                                    </div>
                                </div>

                                <div class="input-div pass">
                                    <div class="i">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="div">
                                        <h5>Nome Completo</h5>
                                        <input type="text" name="nome" class="input" required>
                                    </div>
                                </div>

                                <div class="input-div pass">
                                    <div class="i">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="div">
                                        <h5>Email</h5>
                                        <input type="email" name="email" class="input" required>
                                    </div>
                                </div>

                                <div class="input-div pass">
                                    <div class="i">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                    <div class="div">
                                        <h5>Senha</h5>
                                        <input type="password" name="senha" id="input-senha" class="input" required>
                                    </div>
                                </div>

                                <div class="input-div pass mb-3">
                                    <div class="i">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                    <div class="div">
                                        <h5>Confirmar Senha</h5>
                                        <input type="password" name="senhacon" id="input-confirma-senha" class="input" required>
                                    </div>
                                </div>

                                <div id="span-erros" class="span-erros"></div>

                                <button class="btn btn-sucesso mb-2" id="input-submit">Cadastre-se</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal text-dark div-fade animacao-modal" id="ModalMultiUso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header w-100" id="cabecalho-modal">

                    </div>
                    <div class="modal-body" id="modal-body">
                        Falha ao realizar ação. Tente novamente com outro login e email.
                    </div>
                    <div class="modal-footer" id="modal-footer">
                        <button type="button" class="btn btn-outline-dark" onclick="event.preventDefault();" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="/js/cadastro/cadastro.js"></script>
    <script src="/js/cadastro/submitinfo.js"></script>
@endsection
