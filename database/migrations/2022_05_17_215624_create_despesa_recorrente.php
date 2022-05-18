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
        Schema::create('despesa_recorrente', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome');
            $table->date('data');
            $table->float('valor');
            $table->string('forma_pagamento');
            $table->boolean('status')->default(0);
            $table->binary('boleto')->nullable();
            $table->binary('comprovante')->nullable();
            $table->string('comentario')->nullable();

            $table->string('id_user');
            $table->foreign('id_user')->references('id')->on('users');

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
        Schema::dropIfExists('despesa_recorrente');
    }
};
