<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Faturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faturas',function (Blueprint $table){
            $table->id();
            $table->string('data_compra');
            $table->string('hora_compra');
            $table->string('reference_code');
            $table->string('valor');
            $table->string('status');
            $table->integer('qtd_aulas');
            $table->string('transaction_code');
            $table->string('eventoid');
            $table->foreign('eventoid')->references('id')->on('eventos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faturas');
    }
}
