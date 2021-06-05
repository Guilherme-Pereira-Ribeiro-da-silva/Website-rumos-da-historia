<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailAgendamentoConfirmadoAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject = "Atenção!Um novo agendamento de aula teve o seu pagamento confirmado";
    public $nome_aluno;
    public $tipo_aula;
    public $data;
    public $hora;
    public $url;
    
    public function __construct($nome_aluno,$tipo_aula,$data,$hora,$url)
    {
        $this->nome_aluno = $nome_aluno;
        $this->tipo_aula = $tipo_aula;
        $this->data = $data;
        $this->hora = $hora;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.agendamento.emailAgendamentoConfirmadoAdmin');
    }
}
