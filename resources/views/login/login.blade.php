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
                                <h4>Login</h4>
                                <div class="input-div one">
                                    <div class="i">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="div">
                                        <h5>Login</h5>
                                        <input type="text" name="login" id="input-login" class="input" required>
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

                                <div id="span-erros" class="span-erros"></div>

                                <a href="/login/recuperar" class="mt-1 mb-2">Esqueceu a senha?</a>
                                <a href="/cadastro" class="mt-1 mb-2">Ainda não é nosso aluno?</a>
                                <input type="submit" class="btn btn-sucesso mb-2" value="Logue-se" onclick="Logar('aluno')" id="input-submit">
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
                        Login ou senha incorretos ou email não confirmado.Tente novamente.
                    </div>
                    <div class="modal-footer" id="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="/js/login/login.js"></script>
@endsection
