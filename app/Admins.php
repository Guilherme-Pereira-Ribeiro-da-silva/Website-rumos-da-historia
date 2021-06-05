<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admins extends Model
{
    protected $table = "admins";
    public $timestamps = false;
    protected $fillable = ['nome','email','login','senha','foto'];
}
