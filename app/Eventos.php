<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    public $timestamps = false;
    protected $table = "eventos";
    protected $fillable = ['nome','ano','mes','dia','data','hora','alunoid','alteracoes','area-historia','conteudo-especifico'];

    public function Alunos()
    {
        return $this->belongsTo('\App\Alunos','alunoid');
    }

    public function Faturas()
    {
        return $this->hasMany('\App\Faturas','eventoid');
    }

    public function Reunioes_zoom()
    {
        return $this->hasMany('\App\Reunioes_Zoom','eventoid');
    }
}
