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
        Schema::create('parcela', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('parcela');
            $table->date('data');
            $table->decimal('valor');
            $table->string('comentario')->nullable();
            $table->boolean('status')->default(0);

            $table->string('id_despesa_parcelada');
            $table->foreign('id_despesa_parcelada')->references('id')->on('despesa_parcelada');

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
        Schema::dropIfExists('parcela');
    }
};
