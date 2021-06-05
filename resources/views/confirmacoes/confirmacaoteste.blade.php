@extends('layoutpadrao')


@section('body')
    <div class="modal fade" id="modalConfirmacao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    @if($result === true)
                        <div id="true">
                            Conta Confirmada com sucesso!Logue-se
                        </div>
                    @else
                        <div id="false">
                            Falha ao confirmar conta!Tente novamente!
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src ="{{URL::asset('js/confirmacoes/confirmacao.js')}}"></script>
@endsection
