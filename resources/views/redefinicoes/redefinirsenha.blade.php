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
                                <h4>Redefinir Senha</h4>
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

                                <div id="span-erros" class="span-erros mb-2 max-width-80"></div>

                                <input type="button" class="btn btn-sucesso mb-2" value="Redefinir senha" id="input-submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal text-dark animacao-modal" id="ModalMultiUso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header w-100" id="cabecalho-modal">

                    </div>
                    <div class="modal-body" id="modal-body">

                    </div>
                    <div class="modal-footer" id="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{URL::asset('/js/redefinicoes/recriar_senha.js')}}"></script>
    <script>
        ValidarToken({{$result}});
    </script>
@endsection
