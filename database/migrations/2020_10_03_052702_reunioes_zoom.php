<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReunioesZoom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("reunioes_zoom",function (Blueprint $table){
            $table->id();
            $table->string("data_inicio");
            $table->string("data_criacao");
            $table->string("url_inicio",1000);
            $table->string("url_entrada",1000);
            $table->string("senha");
            $table->integer("eventoid");
            $table->foreign("eventoid")->references("id")->on("eventos");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("reunioes_zoom");
    }
}
