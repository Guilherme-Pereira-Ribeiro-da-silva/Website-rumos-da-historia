<?php


namespace App\Services;

use Illuminate\Http\Request;

class TratamentoCadastro
{
    public function ValidarSenha(Request $request)
    {
        $senha = $this->CriptografarSenha($request->senha);
        $senhacon = $this->CriptografarSenha($request->senhacon);
        return $senhacon === $senha && strlen($senha) >= 8;
    }

    public function CriptografarSenha($senha)
    {
        return crypt($senha,"thisisasalt");
    }
}
