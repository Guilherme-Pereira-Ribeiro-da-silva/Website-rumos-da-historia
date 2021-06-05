<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailConfirmacao extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject;
    public $corpo;
    public $aluno;
    public $id;
    public $token;

    public function __construct($corpo,$aluno,$id,$token,$subject)
    {
        $this->corpo = $corpo;
        $this->aluno = $aluno;
        $this->id = $id;
        $this->token = $token;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.emailConfirmacao');
    }
}
