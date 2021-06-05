<?php

namespace App\Traits;

use App\Http\Controllers\AlunosController;
use Illuminate\Http\Request;

trait TesteLogin{

    public static function TesteLogin($class,$login,$senha)
    {
        return $class::where('login','=',$login)->where('senha','=',$senha)->count() > 0;
    }
}
