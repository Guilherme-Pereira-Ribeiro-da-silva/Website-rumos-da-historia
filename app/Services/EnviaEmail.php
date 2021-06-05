<?php


namespace App\Services;


use App\Mail\EmailAgendamentoAberto;
use App\Mail\EmailAgendamentoConfirmado;
use App\Mail\EmailAgendamentoConfirmadoAdmin;
use App\Mail\EmailAgendamentoAlteradoAdmin;
use App\Mail\EmailAgendamentoAlterado;
use App\Mail\EmailConfirmacao;
use App\Mail\EmailRecuperacao;
use Illuminate\Support\Facades\Mail;

class EnviaEmail
{
    public static function EmailConfirmacao($email,$token,$login,$id){
        try{
            $corpo = "Olá!Bem vindo ao site da professora Aline!Confirme sua conta pelo link abaixo";
            $subject = "Bem vindo ao site da professora Aline!";
    
            $email_montado = new EmailConfirmacao($corpo,$login,$id,$token,$subject);
    
            $user = (object)[
                'email' => $email,
                'name' => $login
            ];
            Mail::to($user)->send($email_montado);
            
        }catch (\Exception $erro){
            return array(
              'result' => false,
              'exception' => $erro->getMessage()
            );
        }
    }

    public static function EmailRecuperacao($email,$token,$login,$id)
    {
        try {

            $email_montado = new EmailRecuperacao($login,$token,$id);

            $user = (object)[
                'email' => $email,
                'name' => $login
            ];

            Mail::to($user)->send($email_montado);

            return array(
                'result' => true
            );
        }catch (\Exception $erro){
            return array(
              'result' => false,
              'exception' => $erro->getMessage()
            );
        }
    }

    public static function EmailAgendamentoAberto($nome_aluno,$tipo_aula,$data,$hora,$email)
    {
        try {
            $email_montado = new EmailAgendamentoAberto($nome_aluno, $tipo_aula, $data, $hora);

            $user = (object)[
                'email' => $email,
                'login' => $nome_aluno
            ];

            Mail::to($user)->send($email_montado);

            return array(
                'result' => true
            );
        }catch(\Exception $erro){
            return array(
                'result' => false,
                'exception' => $erro->getMessage()
            );
        }
    }
    
    public static function EmailAgendamentoConfirmado($nome_aluno,$tipo_aula,$data,$hora,$email,$url)
    {
        try {
            $email_montado = new EmailAgendamentoConfirmado($nome_aluno, $tipo_aula, $data, $hora,$url);
            
            $user = (object)[
                'email' => $email,
                'login' => $nome_aluno
            ];

            Mail::to($user)->send($email_montado);

        }catch(\Exception $erro){
            return $erro->getMessage();
        }
    }
    
    public static function EmailAgendamentoConfirmadoAdmin($nome_aluno,$tipo_aula,$data,$hora,$email,$url)
    {
        try {
            $email_montado = new EmailAgendamentoConfirmadoAdmin($nome_aluno, $tipo_aula, $data, $hora,$url);
            
            $user = (object)[
                'email' => $email,
                'login' => $nome_aluno
            ];

            Mail::to($user)->send($email_montado);

        }catch(\Exception $erro){
            return $erro->getMessage();
        }
    }
    
    public static function EmailAgendamentoAlterado($nome_aluno,$tipo_aula,$data,$hora,$email)
    {
        try {
            $email_montado = new EmailAgendamentoAlterado($nome_aluno, $tipo_aula, $data, $hora);
            
            $user = (object)[
                'email' => $email,
                'login' => $nome_aluno
            ];

            Mail::to($user)->send($email_montado);

        }catch(\Exception $erro){
            return $erro->getMessage();
        }
    }
    
    public static function EmailAgendamentoAlteradoAdmin($nome_aluno,$tipo_aula,$data,$hora,$email)
    {
        try {
            $email_montado = new EmailAgendamentoAlteradoAdmin($nome_aluno, $tipo_aula, $data, $hora);
            
            $user = (object)[
                'email' => $email,
                'login' => $nome_aluno
            ];

            Mail::to($user)->send($email_montado);

        }catch(\Exception $erro){
            return $erro->getMessage();
        }
    }
}
