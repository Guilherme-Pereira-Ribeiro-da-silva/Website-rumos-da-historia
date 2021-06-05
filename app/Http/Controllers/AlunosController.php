<?php

namespace App\Http\Controllers;

use App\Alunos;
use App\Mail\EmailRecuperacao;
use App\Services\EnviaEmail;
use App\Services\CalcularPreco;
use App\Services\TratamentoCadastro;
use App\Traits\TesteLogin;
use Illuminate\Http\Request;

class AlunosController extends BaseCrudController
{
    public function __construct()
    {
        $this->classe = Alunos::class;
    }

    public function LoginPage()
    {
        return view('login.login');
    }

    public function HomePage()
    {
        return view('alunos.home');
    }

    public function RecuperarPage()
    {
        return view('redefinicoes.recuperarsenha');
    }

    function Confirmar($alunoid){
        $this->classe::find($alunoid)->update(['confirmado' => 1]);
    }

    public function Store(Request $request)
    {
        $tratamentocadastro = new TratamentoCadastro();
        $request->merge([
                'senha' => $tratamentocadastro->CriptografarSenha($request->senha),
                'senhacon' => $tratamentocadastro->CriptografarSenha($request->senhacon)
            ]);

        if(!$tratamentocadastro->ValidarSenha($request)){
            return response()->json([
                'result' => 'senhas não batem'
            ],401);
        }

        try{

            $result = $this->classe::create($request->all());

            $request->request->add([
                'alunoid' => $result->id
            ]);

            $confirmacoes = new ConfirmacoesController();
            $confirmacoes->Store($request);

            return \response()->json([
                'result' => $result,
            ],200);
        }catch (\Exception $erro){
            return response()->json([
                'result' => $erro->getMessage()
            ],500);
        }
    }

    public function Logar(Request $request)
    {
        $tratamentocadastro = new TratamentoCadastro();
        $request->merge([
            'senha' => $tratamentocadastro->CriptografarSenha($request->senha)
        ]);

        if($this->classe::where('login',$request->login)->where('senha',$request->senha)->where('confirmado',1)->count() > 0){
            SessionController::CriarSessionAlunos($request);
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

    public function UpdateSenha(Request $request,TratamentoCadastro $tratamentoCadastro)
    {
        try{
            if(!$tratamentoCadastro->ValidarSenha($request)){
                return response()->json([
                    'result' => false,
                    'exception' => "As senhas precisam ser iguais"
                ],400);
            }else{
                $request->senha = $tratamentoCadastro->CriptografarSenha($request->senha);
                
                $this->classe::find($request->id)->update(['senha' => $request->senha]);
                return response()->json([
                    'result' => true,
                ],200);
            }
        }catch(\Exception $erro){
            return response()->json([
                    'result' => false,
                    'exception' => $erro->getMessage()
                ],400);
        }
    }

    public function VerificarSenhaShow(Request $request){
        $request->request->add(['login' => $request->session()->get('aluno')]);
        $result = $this->Logar($request);

        $msg = $result->original['result'];

        if ($msg === "Login ou senha incorretos") {
            return response()->json([
                'result' => 'não autorizado'
            ],401);
        }else{
            $this->campo = "login";
            return response()->json([
               'result' => $this->Show($request)
            ],200);
        }
    }

    public function Update(request $request,TratamentoCadastro $tratamento){
        try {
                $result = $this->classe::where('login', $request->session()->get('aluno'))->first();
    
                $emailUpdate = false;
    
                if ($request->has('email') && strlen($request->get('email')) > 0) {
                    $result->email = $request->email;
                    $emailUpdate = true;
                }
                if ($request->has('rua') && strlen($request->get('rua')) > 0) {
                    $result->rua = $request->rua;
                }
                if ($request->has('bairro') && strlen($request->get('bairro')) > 0) {
                    $result->bairro = $request->bairro;
                }
                if ($request->has('numero') && strlen($request->get('numero')) > 0) {
                    $result->numero = $request->numero;
                }
                if ($request->has('cidade') && strlen($request->get('cidade')) > 0) {
                    $result->cidade = $request->cidade;
                }
                if ($request->has('estado') && strlen($request->get('estado')) > 0) {
                    $result->estado = $request->estado;
                }
                if ($request->has('cep') && strlen($request->get('cep')) > 0) {
                    $result->cep = $request->cep;
                }
                if ($request->has('senha') && strlen($request->get('senha')) > 0) {
                    if(strlen($request->senha) < 8){
                        throw new \Exception("A senha necessita de ao menos 8 caracteres");
                    }
                    $result->senha = $tratamento->CriptografarSenha($request->senha);
                }
    
                if($result->save()){
                    $emailUpdate ? $this->DesconfirmarAluno($request) : "";
                    return response()->json([
                        'result' => true,
                        'parameters' => $result
                    ], 200);
                }else{
                    return response()->json([
                        'result' => false
                    ], 400);
                }
        }catch (\Exception $erro){
            return response()->json([
                'result' => false,
                'exception' => $erro->getMessage()
            ],400);
        }
    }

    private function DesconfirmarAluno(Request $request) :void{
        $result = $this->classe::where('login', $request->session()->get('aluno'))->first();
        $result->confirmado = 0;
        $result->save();

        $request->request->add([
            'login' => $result->login,
            'alunoid' => $result->id
        ]);

        $confirmacoes = new ConfirmacoesController();
        $confirmacoes->Store($request);
    }
    
    public function TestarExistenciaEndereco(Request $request){
        try{
            $result = $this->classe::where('login',$request->session()->get("aluno"))->get();

            return response()->json([
                'result' => strlen($result[0]->cidade) > 0,
            ],200);
        }catch(\Exception $erro){
            return response()->json([
                'result' => false,
                'exception' => $erro->getMessage()
            ],400);
        }
    }
    
    public function GetCEP(Request $request){
        try{
            $result = $this->classe::where('login',session()->get("aluno"))->get();
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://www.cepaberto.com/api/v3/cep?cep=".$result[0]->cep);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Token token=98b8fdd7c5c538c26f1db3f9fe0e70e8',
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            $output = json_decode($output);
            curl_close($ch);
            
            $array_info_preco = CalcularPreco::CalcularDistancia(floatval(env("latitude_hq")),floatval(env("longitude_hq")),$output->latitude,$output->longitude);
            if(in_array(false,$array_info_preco)){
                throw new \Exception("muito longe");
            }else{
                return response()->json([
                    'result' => array(
                        'cep' => $result[0]->cep,
                        'preco' => $array_info_preco["preco"],
                        'distancia' => $array_info_preco["distancia"]
                    )
                ],200);   
            }
        }catch(\Exception $erro){
            return response()->json([
                'result' => false,
                'exception' => $erro->getMessage()
            ],400);
        }
    }
}
