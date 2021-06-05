<?php

namespace App\Http\Controllers;

use App\Reunioes_Zoom;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;

class ZoomController extends BaseCrudController
{
    public function __construct()
    {
        $this->classe = Reunioes_Zoom::class;
    }

    public function MandarRequest($info){
        $url = 'https://api.zoom.us/v2/users/me/meetings';
        $headers = array(
            "authorization: Bearer ".$this->GerarJWTkey(),
            "content-type: application/json"
        );

        $campos = json_encode($info);

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $campos);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response,JSON_UNESCAPED_UNICODE);
    }

    private function GerarJWTkey(){
        $zoom_key = env("ZOOM_API_KEY");
        $zoom_secret = env("ZOOM_API_SECRET");
        $token = array(
            "iss" => $zoom_key,
            "exp" => time() + 3600
        );
        return JWT::encode($token,$zoom_secret);
    }

    public function CriarReuniao($info_reuniao){
        try{
            $array = array();
            $array['topic']      = $info_reuniao["topic"];
            $array['agenda']     = $info_reuniao["agenda"];
            $array['type']       = 2; //Agendado
            $array['start_time'] = $info_reuniao["inicio"];
            $array['timezone']   = "America/Sao_Paulo";
            $array['password']   = $info_reuniao["senha"];
            $array['duration']   = 80;
            $array['settings']   = array(
                'join_before_host'  => true,
                'host_video'        => true,
                'participant_video' => true,
                'mute_upon_entry'   => false,
                'enforce_login'     => false,
                'auto_recording'    => "none",
                'alternative_hosts' => isset( $alternative_host_ids ) ? $alternative_host_ids : ""
            );
            
            $response = $this->MandarRequest($array);
            
            $this->CriarResquestStore($response,$info_reuniao["eventoid"]);
            
            return $response;
        }catch(\Exception $erro){
            return $erro->getMessage();
        }
    }

    public function CriarResquestStore($info,$eventoid){
        try{
            $request = new Request([
                'data_inicio' => $info["start_time"],
                'data_criacao' => $info["created_at"],
                'url_inicio' => $info["start_url"],
                'url_entrada' => $info["join_url"],
                'senha' => $info["password"],
                'eventoid' => $eventoid
            ]);

            $this->Store($request);
        }catch(\Exception $erro){
            return $erro->getMessage();
        }
    }
}
