<?php

namespace App\Http\Controllers;

use App\Faturas;
use App\Services\EnviaEmail;
use Illuminate\Http\Request;
class PagSeguroController extends BaseCrudController
{
    public function __construct()
    {
        $this->classe = Faturas::class;
    }

    public function GerarToken (Request $request,AlunosController $alunos,EventosController $eventos) {
        try {

            $data = array($request->dia, $request->mes, $request->ano);

            $info_tipo = $this->TipoAula($request->tipo_aula, $request->hora, $data);
            
            $request->request->add([
                'login' => $request->session()->get('aluno')
            ]);

            $alunos->campo = "login";
            $info_aluno = $alunos->Show($request);
            $info_aluno = $info_aluno->original['result'][0];

            $request->request->add([
                'alunoid' => $info_aluno->id,
                'nome' => $info_tipo[2],
            ]);

            $result = $eventos->Store($request);

            if (env('PAGSEGURO_SANDBOX')) {
                $email = "c79255145281907733675@sandbox.pagseguro.com.br";
                $Url = "https://ws.sandbox.pagseguro.uol.com.br/v2/checkout";
            } else {
                $email = $info_aluno->email;
                $Url = "https://ws.sandbox.pagseguro.uol.com.br/v2/checkout";
            }

            $ref = rand(1, 999999999);
            $Data["email"] = env('PAGSEGURO_EMAIL');
            $Data["token"] = env('PAGSEGURO_TOKEN');
            $Data["currency"] = "BRL";
            $Data["itemId1"] = strval($result->original['result']->id);
            $Data["itemDescription1"] = $info_tipo[0];
            $Data["itemAmount1"] = $info_tipo[1];
            $Data["itemQuantity1"] = "1";
            $Data["itemWeight1"] = "1000";
            $Data["reference"] = strval($ref);
            $Data["senderName"] = $info_aluno->nome;
            $Data["senderAreaCode"] = "37";
            $Data["senderPhone"] = '99999999';
            $Data["senderEmail"] = $email;
            $Data["shippingType"] = "1";
            $Data["shippingAddressStreet"] = $info_aluno->rua;
            $Data["shippingAddressNumber"] = $info_aluno->numero;
            $Data["shippingAddressComplement"] = "Casa";
            $Data["shippingAddressDistrict"] = $info_aluno->bairro;
            $Data["shippingAddressPostalCode"] = $info_aluno->cep;
            $Data["shippingAddressCity"] = $info_aluno->cidade;
            $Data["shippingAddressState"] = $info_aluno->estado;
            $Data["shippingAddressCountry"] = "BRA";

            $BuildQuery = http_build_query($Data);

            $Curl = curl_init($Url);
            curl_setopt($Curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
            curl_setopt($Curl, CURLOPT_POST, true);
            curl_setopt($Curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($Curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($Curl, CURLOPT_POSTFIELDS, $BuildQuery);
            $Retorno = curl_exec($Curl);
            curl_close($Curl);

            $Xml = simplexml_load_string($Retorno);

            if(strlen($Xml->code) === 0){
                throw new \Exception('Falha na geração do token');
            }

            $request->request->add([
                'data_compra' => date('d/m/Y'),
                'hora_compra' => date('H:i:s'),
                'transaction_code' => $Xml->code,
                'reference_code' => $ref,
                'qtd_aulas' => 1,
                'eventoid' => $result->original['result']->id,
                'status' => 1,
                'valor' => $info_tipo[1],
            ]);

            $this->Store($request);

            $data_aula = $data[0]."/".$data[1]."/".$data["2"];
            $result = EnviaEmail::EmailAgendamentoAberto($info_aluno->nome,$info_tipo[2],$data_aula,$request->hora,$info_aluno->email);

            if(!$result['result']){
                throw new \Exception($result['exception']);
            }

            return response()->json([
                'result' => $Xml->code
            ], 200);
        }catch (\Exception $erro){
            return response()->json([
                'result' => $erro->getMessage()
            ], 400);
        }
    }

    public function Notificacoes(Request $request)
    {
        try{
            $Url="https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/{$request->notificationCode}?email=".env("PAGSEGURO_EMAIL")."&token=".env("PAGSEGURO_TOKEN")."";
    
            $Curl=curl_init($Url);
            curl_setopt($Curl,CURLOPT_SSL_VERIFYPEER,true);
            curl_setopt($Curl,CURLOPT_RETURNTRANSFER,true);
            $Retorno=curl_exec($Curl);
            curl_close($Curl);
            $Xml=simplexml_load_string($Retorno);
            if(strlen($Xml->status) > 0 && strlen($Xml->reference) > 0){
                if($this->AtualizaCodigo($Xml->status,$Xml->reference)){
                    $message = "ok";
                    $status = 200;
                }else{
                    $message = "Internal Server Error";
                    $status = 500;
                }
                return response()->json([
                    $message
                    ],$status);
            }else{
                throw new \exception("Erro no recebimento");
            }
        }catch(\Exception $erro){
            return response()->json([
                $erro->getMessage()
                ],500);
        }
    }

    public function TipoAula($tipo,$horario,$data)
    {
        switch ($tipo){
            case 1:
                $fim_aula = $horario + 1;
                $preco = "50.00"; //pagseguro não aceita float
                $descricao ="Aula Online no dia ".$data[0]."/".$data[1]."/".$data[2]." das " . $horario . " às " . $fim_aula . " horas";
                $nome = "aula online";
                return array($descricao,$preco,$nome);
            break;
            
            case 2:
                $alunos = new AlunosController();
                $request = new Request();
                $aluno_info = $alunos->GetCEP($request);
                $preco = $aluno_info->original["result"]["preco"];
                $fim_aula = $horario + 1;
                $preco = $preco.".00"; //pagseguro não aceita float
                $descricao ="Aula Presencial no dia ".$data[0]."/".$data[1]."/".$data[2]." das " . $horario . " às " . $fim_aula . " horas";
                $nome = "aula Presencial";
                return array($descricao,$preco,$nome);
            break;
        }
    }

    public function AtualizaCodigo($codigo,$reference)
    {
        try{
            $result = $this->classe::where('reference_code',$reference)->first();
            intval($codigo) === 3 ? EventosController::ConfirmaEvento($result) : "";
            $result->status = $codigo;
            return $result->save();
        }catch(\Exception $erro){
            return $erro->getMessage();
        }
    }

    public function ArrayLucroMeses(Request $request)
    {
        $results = $this->classe::with('eventos')->where('status',3)->get();

        foreach ($results as $result){

            if(intval($result->eventos->ano) === intval($request->ano)){
                if(empty($array[$result->eventos->mes])){
                    $array[$result->eventos->mes -1] = $result->valor;
                }else{
                    $array[$result->eventos->mes -1] += $result->valor;
                }
            }
        }

        for($i =11;$i>=0;$i--){
            empty($array[$i]) ? $array[$i] = 0 : "";
        }

        return response()->json(['result' => $array],200);
    }
}

