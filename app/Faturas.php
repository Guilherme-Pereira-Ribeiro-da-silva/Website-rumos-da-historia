<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faturas extends Model
{
    protected $table = "faturas";
    public $timestamps = false;
    protected $fillable = ['reference_code','data_compra','hora_compra','valor','status','qtd_aulas','transaction_code','eventoid'];

    public function Eventos()
    {
        return $this->belongsTo('\App\Eventos','eventoid');
    }
}
