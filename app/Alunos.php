<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alunos extends Model
{
    protected $fillable = ['nome','email','login','senha','foto','confirmado','numero','rua','bairro','cidade','estado','cep','telefone'];
    public $timestamps = false;

    public function Eventos(){
       return $this->hasMany('\App\Eventos','alunoid');
    }

    public function Confirmacoes(){
        return $this->hasMany('\App\Confirmacoes','alunoid');
    }

    public function Recuperacoes()
    {
        return $this->hasMany('\App\Recuperacoes','alunoid');
    }
}
