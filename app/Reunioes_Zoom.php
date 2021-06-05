<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reunioes_Zoom extends Model
{
    public $timestamps = false;
    protected $table = "reunioes_zoom";
    protected $fillable = ["data_inicio","data_criacao","url_inicio","url_entrada","senha","eventoid"];

    public function Eventos(){
        $this->belongsTo('App\Eventos','eventoid');
    }
}
