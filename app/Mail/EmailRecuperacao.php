<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailRecuperacao extends Mailable
{
    use Queueable, SerializesModels;

    public $login_aluno;
    public $token;
    public $id;
    public $subject = "Olá.Recebemos seu pedido de recuperação de senha.";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($login_aluno,$token,$id)
    {
        $this->login_aluno = $login_aluno;
        $this->token = $token;
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.emailRecuperacao');
    }
}
