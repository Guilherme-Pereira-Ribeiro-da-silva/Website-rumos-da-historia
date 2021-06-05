<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public static function CriarSessionAlunos(Request $request)
    {
        $request->session()->put('aluno',$request->login);
    }

    public static function CriarSessionAdmins(Request $request)
    {
        $request->session()->put('admin',$request->login);
    }

    public function Sair(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}
