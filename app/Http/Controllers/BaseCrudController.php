<?php

namespace App\Http\Controllers;

use App\Admins;
use App\Services\TratamentoCadastro;
use App\Traits\TesteLogin;
use Illuminate\Http\Request;

abstract class BaseCrudController extends Controller
{
    use TesteLogin;

    protected $classe;
    public $campo;


    public function __construct($classe)
    {
        $this->classe = $classe;
    }

    public function Index(Request $request)
    {
        if(!$request->has('page') || !$request->has('per_page')){
            return response()->json([
                'result' =>  false
            ],404);
        }

        $offset = ($request->page -1) * $request->per_page;
        $result = $this->classe::query()->offset($offset)->limit($request->per_page)->get();

        if(is_null($result) || $result->count() === 0){
            return response()->json([
            'result' =>  false
            ],404);
        }

        return response()->json([
            'result' => $result,
            'count' => $this->CountIndex()
        ],200);
    }

    public function CountIndex(): int
    {
        return $this->classe::all()->count();
    }

    public function Destroy(Request $request)
    {
        try {
            $this->classe::destroy($request->id);
            return response()->json([
                'result' => true
            ],200);
        }catch (\Exception $erro){
            return response()->json([
                'result' => $erro->getMessage()
            ],500);
        }

    }

    public function Store(Request $request)
    {

        try{
            $result = $this->classe::create($request->all());

            return \response()->json([
                'result' => $result,
            ],200);
        }catch (\Exception $erro){
            return response()->json([
                'result' => $erro->getMessage()
            ],500);
        }

    }

    public function Show(Request $request)
    {
        $nome_campo = $this->campo;
        $result = $this->classe::where($this->campo,$request->$nome_campo)->first();

        if($result->count() === 0){
            $result = false;
        }

        return response()->json([
            'result' => array($result)
        ],200);
    }
    
    public function Atualizar(Request $request){
        try{
            $result = $this->classe::find($request->id);
            $result->fill($request->all());
            $result->alteracoes = $result->alteracoes + 1;
            $result->save();
            return response()->json([
                'result' => $result
                ]);
        }catch(Exception $erro){
            return response()->json([
                'result' => false,
                'exception' => $erro->getMessage()
            ],400);
        }
    }
}
