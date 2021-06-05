<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recuperacoes extends Model
{
    public $timestamps = false;
    protected $fillable = ["token","alunoid"];
    protected $table = "recuperacoes";

    public function Alunos()
    {
        return  $this->belongsTo('\App\Alunos','alunoid','id');
    }
}
