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
                                <img src="{{URL::asset('images/logincadastro/fotocadastro.png')}}" alt="foto-cadastro" title="foto cadastro">
                                <h4>Recuperar Senha</h4>
                                <div class="input-div one">
                                    <div class="i">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="div">
                                        <h5>Email</h5>
                                        <input type="text" name="login" id="input-email" class="input" required>
                                    </div>
                                </div>

                                <div id="span-erros" class="span-erros"></div>

                                <input type="submit" class="btn btn-sucesso mb-2" value="Recuperar senha" onclick="fetchRecuperar()" id="input-submit">
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
                        Email não encontrado em nossa base de dados.Tem certeza de que está usando o email correto?
                    </div>
                    <div class="modal-footer" id="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{URL::asset('/js/redefinicoes/recuperar_senha.js')}}"></script>
@endsection
