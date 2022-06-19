<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arquivo_receita', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tipo');
            $table->string('nome_original');
            $table->string('extensao');
            $table->string('tamanho');
            $table->string('tipo_documento');

            $table->string('id_receita');
            $table->foreign('id_receita')->references('id')->on('receita');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arquivo_receita');
    }
};
