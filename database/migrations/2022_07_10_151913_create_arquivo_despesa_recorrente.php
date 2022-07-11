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
        Schema::create('arquivo_despesa_recorrente', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tipo');
            $table->string('nome_original');
            $table->string('extensao');
            $table->string('tamanho');
            $table->enum('tipo_documento', ['c', 'b'])->nullable();

            $table->string('id_despesa_recorrente');
            $table->foreign('id_despesa_recorrente')
                ->references('id')
                ->on('despesa_recorrente')
                ->onDelete('cascade');

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
        Schema::dropIfExists('arquivo_despesa_recorrente');
    }
};
