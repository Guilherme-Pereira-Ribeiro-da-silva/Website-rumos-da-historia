<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/cadastro', function () {
    return view('cadastro.cadastro');
});

Route::get('/loginadmin','AdminsController@LoginPage');
Route::post('/loginadmin','AdminsController@Logar');


Route::get('/login', 'AlunosController@LoginPage');
Route::post('/login','AlunosController@Logar');

Route::get('/login/recuperar', 'AlunosController@RecuperarPage');
Route::get('/login/redefinir','AlunosController@RedefinirPage');
Route::post('/login/recuperar', 'RecuperacoesController@TentarRecuperar');
Route::post('/login/redefinir','AlunosController@RedefinirPage');

Route::post('/notificacoes','PagSeguroController@Notificacoes');

Route::post('/alunos','AlunosController@Store');

Route::get('/sair','SessionController@Sair');

Route::patch('/email/redefinicao','AlunosController@UpdateSenha');

Route::get('/email/confirmacao/{token}/{id}','ConfirmacoesController@TestarToken');
Route::get('/email/redefinicao/{token}/{id}','RecuperacoesController@TestarToken');


Route::post("/reuniao","ZoomController@CriarReuniao");


Route::group(['middleware' => 'autenticacaoAluno'],function (){
    Route::get('/alunos/cep','AlunosController@GetCEP');
    Route::get('/alunos/testeendereco','AlunosController@TestarExistenciaEndereco');
    Route::get('/alunos/home','AlunosController@HomePage');
    Route::post('/pagamento','PagSeguroController@GerarToken');
    Route::post('/alunos/eventos/alterar/{id}','EventosController@Alteracao');
    Route::get('/alunos/eventos/{dia}/{mes}/{ano}','EventosController@ShowWithoutDetails');
    Route::get('/alunos/eventos/{page}/{perpage}','EventosController@IndexAluno');
    Route::post('/alunos/info','AlunosController@VerificarSenhaShow');
    Route::post('/alunos/editar','AlunosController@Update');
});

Route::group(['middleware' => 'autenticacaoAdmins'],function (){
    Route::get('/admin','AdminsController@HomePage');

    Route::get('/alunos','AlunosController@Index');


    Route::get('/admins','AdminsController@Index');
    Route::post('/admins','AdminsController@Store');
    Route::delete('/admins/{id}','AdminsController@destroy');

    Route::get('/eventos/{ano}','EventosController@Index');
    Route::get('/eventos/{dia}/{mes}/{ano}','EventosController@Show');

    Route::get('/receita/{ano}','PagSeguroController@ArrayLucroMeses');
});



