<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Alunos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos',function (Blueprint $table){
            //info obrigatória cadastro
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('login')->unique();
            $table->string('senha');
            $table->boolean('confirmado')->default(false);

            //info não obrigatória cadastro
            $table->string('foto')->nullable();
            $table->integer('numero')->nullable();
            $table->string('rua')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado',2)->nullable();
            $table->string('cep')->nullable();
            $table->string('telefone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos');
    }
}
