<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Eventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos',function (Blueprint $table){
            $table->id();
            $table->string('nome');
            $table->integer('ano');
            $table->integer('mes');
            $table->integer('dia');
            $table->integer('hora'); //só horários inteiros (13,14,15...)
            $table->integer('alunoid');
            $table->foreign('alunoid')->references('id')->on('alunos');
            $table->boolean('confirmado')->default(false);
            $table->integer('alteracoes')->default(0);
            $table->string('area-historia');
            $table->string('conteudo-especifico');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}
