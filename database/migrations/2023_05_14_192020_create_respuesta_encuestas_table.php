<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('respuesta_encuestas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pregunta_encuesta_id');
            $table->integer('user_id');
            $table->string('respuesta', 500);
            $table->timestamps();

            $table->foreign('pregunta_encuesta_id')->references('id')->on('pregunta_encuestas');
            $table->foreign('user_id')->references('idusuario')->on('users');

            $table->unique(['pregunta_encuesta_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuesta_encuestas');
    }
};
