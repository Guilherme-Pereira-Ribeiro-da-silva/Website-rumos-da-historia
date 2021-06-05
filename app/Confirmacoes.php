<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confirmacoes extends Model
{
    public $timestamps = false;
    protected $fillable = ["token","alunoid"];
    protected $table = "confirmacoes";

    public function Alunos()
    {
       return  $this->belongsTo('\App\Alunos','alunoid','id');
    }
}
