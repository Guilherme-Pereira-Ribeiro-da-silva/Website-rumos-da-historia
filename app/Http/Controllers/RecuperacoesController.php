<?php

namespace App\Http\Controllers;

use App\Alunos;
use App\Confirmacoes;
use App\Recuperacoes;
use App\Services\EnviaEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class RecuperacoesController extends BaseCrudController
{
    public function __construct()
    {
        $this->classe = Recuperacoes::class;
    }

    public function Store(Request $request)
    {
        try {
            $token = bin2hex(random_bytes(50));

            $request->request->add(['token' => $token]);

            $this->classe::create($request->all());

            $result = EnviaEmail::EmailRecuperacao($request->email,$token,$request->login,$request->alunoid);

            if(!$result['result']){
                throw new \Exception($result['exception']);
            }

            return array(
              'result' => true
            );

        } catch (\Exception $erro) {
            return array(
                'result' => false,
                'exception' => $erro->getMessage()
            );
        }
    }

    public function TentarRecuperar(Request $request)
    {
        if(Alunos::where('email',$request->email)->count() > 0){
            $result = Alunos::where('email',$request->email)->get();

            $request->request->add([
                'alunoid' => $result[0]->id,
                'login' => $result[0]->login
            ]);

            $result = $this->Store($request);

            if(!$result['result']){
                $result = false;
                $status = 400;
            }else{
                $result = true;
                $status = 200;
            }
        }else{
            $result = false;
            $status = 404;
        }

        return response()->json([
            'result' => $result,
        ],$status);
    }

    public function TestarToken(Request $request,AlunosController $alunos)
    {
        if($this->classe::where('token',$request->token)->where('alunoid',$request->id)->count() > 0){
            $alunos->Confirmar($request->id);
            return View::make('redefinicoes.redefinirsenha',[
                'result' => true
            ]);
        }else{
            return View::make('redefinicoes.redefinirsenha',[
                'result' => false
            ]);
        }
    }
}
