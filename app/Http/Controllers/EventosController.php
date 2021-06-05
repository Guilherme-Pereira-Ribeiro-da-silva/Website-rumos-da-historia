<?php

namespace App\Http\Controllers;

use App\Eventos;
use App\Http\Controllers\AlunosController;
use App\Services\EnviaEmail;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class EventosController extends BaseCrudController
{
    public function __construct()
    {
        $this->classe = Eventos::class;
    }

    public function Index(Request $request)
    {
        if(is_null($request->ano)){
            return response()->json([
                'result' => array(false)
            ]);
        }


        $result = $this->classe::where('ano',$request->ano)->where('confirmado',1)->get();

        if($result->count() === 0){
            $result = false;
        }

        return response()->json([
            'result' => array($result)
        ]);
    }

    public function IndexAluno(Request $request)
    {
        if(!isset($request->page) || !isset($request->perpage)){
            return response()->json(['result' => false],400);
        }

        $alunos = new AlunosController();
        $alunos->campo = "login";
        $request->request->add(['login' => $request->session()->get('aluno')]);

        $aluno = $alunos->Show($request);
        $alunoid = $aluno->original['result'][0]->id;

        $offset = ($request->page -1) * ($request->perpage);

        $result = $this->classe::where('alunoid',$alunoid)->offset($offset)->limit($request->perpage)->get();

        if(!$result->count() > 0){
            return response()->json(['result' => array(false)],404);
        }

        return response()->json(['result' => $result],200);

    }

    public function Show(Request $request)
    {
        $result = $this->classe::with('Alunos')->where('ano',$request->ano)->where('mes',$request->mes)->where('dia',$request->dia)->get();

        if($result->count() === 0){
            $result = false;
        }

        return response()->json([
            'result' => array($result),
        ],200);
    }

    public function ShowWithoutDetails(Request $request)
    {
        $result = $this->classe::where('ano',$request->ano)->where('mes',$request->mes)->where('dia',$request->dia)->get();

        if($result->count() === 0){
            $result = false;
        }

        return response()->json([
            'result' => array($result),
        ],200);
    }

    public function GetnumeroProximasAulas()
    {
        $dia = date('d');
        $mes = date('m');
        $ano = date('Y');

        return $this->classe::where('ano','>=',$ano)->where('mes','>=',$mes)->where('dia','>=',$dia)->where('confirmado',1)->count();
    }

    public function GetnumeroAulasAnteriores()
    {
        $dia = date('d');
        $mes = date('m');
        $ano = date('Y');

        return $this->classe::where('ano','=',$ano)->where('mes','<=',$mes)->where('confirmado',1)->count();
    }

    public static function ConfirmaEvento($result){
        
        try{
            $result = Eventos::find(intval($result->eventoid));

            $request = new Request(['id' => $result->alunoid]);

            $aluno = new AlunosController();
            $aluno->campo = "id";

            $info = $aluno->Show($request);
            $info = $info->original["result"][0];

            $data = $result->dia."/".$result->mes."/".$result->ano;

            $array = array(
                'inicio' => $result->ano."/".$result->mes."/".$result->dia."T".$result->hora.":00".":00Z",
                'senha' => rand(1,100000),
                'eventoid' =>$result->id,
                'topic' => $result->nome,
                'agenda' => $result->nome." do dia ".$data.",abrangendo o tema geral ".$result->{"area-historia"}.",com subtema ".$result->{"conteudo-especifico"}
            );
            
            if($result->nome === "aula online"){
                $zoom = new ZoomController();
                $info_reuniao = $zoom->CriarReuniao($array);
                $url_entrada = $info_reuniao["join_url"];
            }else{
                $url_entrada = null;
            }
            
            EnviaEmail::EmailAgendamentoConfirmado($info->nome,$result->nome,$data,$result->hora,$info->email,$url_entrada);
            EnviaEmail::EmailAgendamentoConfirmadoAdmin($info->nome,$result->nome,$data,$result->hora,env("MAIL_USERNAME"),$url_entrada);

            $result->confirmado = 1;
            $result->save();
        }catch(\Exception $erro){
            return $erro->getMessage();
        }
    }
    
    public function Alteracao(Request $request){
        try{
            $result = $this->Atualizar($request);
            $result = $result->original["result"];
            $result->eventoid = $result->id;
            $data_formatada = $result->dia."/".$result->mes."/".$result->ano;
            
            $aluno = new AlunosController();
            $aluno->campo = "id";
            $aluno_request = new Request(['id' => $result->alunoid]);
            $info_aluno = $aluno->Show($aluno_request);
            $resultado = $info_aluno->original["result"][0];
            
            EnviaEmail::EmailAgendamentoAlterado($resultado->nome,$result->nome,$data_formatada,$result->hora,$resultado->email);
            EnviaEmail::EmailAgendamentoAlteradoAdmin($resultado->nome,$result->nome,$data_formatada,$result->hora,env("MAIL_USERNAME"));
            
            
            return response()->json([
                'result' => true,
            ],200);
        }catch(\Exception $erro){
            return response()->json([
                'result' => false,
                'exception' => $erro->getMessage()
            ],400);
        }
        
    }
}
