<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailAgendamentoAlteradoAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject = "Atenção!Um agendamento de aula teve o seu horário alterado!";
    public $nome_aluno;
    public $tipo_aula;
    public $data;
    public $hora;
    public $url;
    
    public function __construct($nome_aluno,$tipo_aula,$data,$hora)
    {
        $this->nome_aluno = $nome_aluno;
        $this->tipo_aula = $tipo_aula;
        $this->data = $data;
        $this->hora = $hora;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.agendamento.emailAgendamentoAlteradoAdmin');
    }
}
