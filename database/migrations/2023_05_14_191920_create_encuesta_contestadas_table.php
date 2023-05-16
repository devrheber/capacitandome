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
        Schema::create('encuesta_contestadas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('encuesta_id');
            $table->integer('curso_id');
            $table->integer('user_id');
            $table->decimal('calificacion');
            $table->timestamps();

            $table->foreign('encuesta_id')->references('id')->on('encuestas');
            $table->foreign('user_id')->references('idusuario')->on('users');
            $table->foreign('curso_id')->references('idcurso')->on('curso');

            $table->unique(['encuesta_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encuesta_contestadas');
    }
};
