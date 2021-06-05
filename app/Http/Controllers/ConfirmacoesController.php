<?php

namespace App\Http\Controllers;

use App\Confirmacoes;
use App\Services\EnviaEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ConfirmacoesController extends BaseCrudController
{
    public function __construct()
    {
        $this->classe = Confirmacoes::class;
    }

    public function Store(Request $request)
    {
        try {
            $token = bin2hex(random_bytes(50));

            $request->request->add(['token' => $token]);

            $this->classe::create($request->all());

            EnviaEmail::EmailConfirmacao($request->email,$token,$request->login,$request->alunoid);
        } catch (\Exception $erro) {
            return $erro->getMessage();
        }
    }

    public function TestarToken(Request $request,AlunosController $alunos)
    {
        if($this->classe::where('token',$request->token)->where('alunoid',$request->id)->count() > 0){
            $alunos->Confirmar($request->id);
            return View::make('confirmacoes.confirmacaoteste',[
                'result' => true
            ]);
        }else{
            return View::make('confirmacoes.confirmacaoteste',[
                'result' => false
            ]);
        }
    }
}
