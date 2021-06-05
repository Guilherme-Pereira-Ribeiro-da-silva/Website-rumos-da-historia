<?php

namespace App\Http\Controllers;

use App\Admins;
use App\Services\TratamentoCadastro;
use App\Traits\TesteLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AdminsController extends BaseCrudController
{
    public function __construct()
    {
        $this->classe = Admins::class;
    }

    public function LoginPage()
    {
        return view('login.loginadmin');
    }

    public function HomePage(Request $request,EventosController $eventos,AlunosController $alunos,PagSeguroController $fatura)
    {
        $request->request->add(['ano' => date('Y')]);

        return View::make('admin.home',[
            'elements' => $fatura->ArrayLucroMeses($request),
            'alunos_cadastrados' => $alunos->CountIndex(),
            'ano' => date('Y'),
            'numero_aulas' => $eventos->GetnumeroProximasAulas(),
            'aulas_dadas'=>$eventos->GetnumeroAulasAnteriores(),
            'numero_admins' => $this->GetNumber()
        ]);
    }

    public function Logar(Request $request)
    {
        $tratamentocadastro = new TratamentoCadastro();
        $request->merge([
            'senha' => $tratamentocadastro->CriptografarSenha($request->senha)
       ]);

        if($this->classe::where('login',$request->login)->where('senha',$request->senha)->count() > 0){
            SessionController::CriarSessionAdmins($request);
            $result = true;
            $status = 200;
        }else{
            $result = 'Login ou senha incorretos';
            $status = 401;
        }

        return response()->json([
            'result' => $result
        ],$status);
    }

    public function Store(Request $request)
    {
        try{
            $tratamentocadastro = new TratamentoCadastro();
            $request->merge([
                'senha' => $tratamentocadastro->CriptografarSenha($request->senha),
            ]);
        
            $result = $this->classe::create($request->all());

            return \response()->json([
                'result' => $result,
            ],200);
        }catch (\Exception $erro){
            return response()->json([
                'result' => $erro->getMessage()
            ],400);
        }
    }

    public function GetNumber()
    {
        return $this->classe::all()->count();
    }
}
