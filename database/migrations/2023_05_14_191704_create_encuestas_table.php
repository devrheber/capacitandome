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
        Schema::create('encuestas', function (Blueprint $table) {
            $table->id();
            $table->integer('curso_id');
            $table->string('titulo', 255);
            $table->string('descripcion', 1500);
            $table->boolean('estado')->default(1);
            $table->timestamps();

            $table->foreign('curso_id')->references('idcurso')->on('curso');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encuestas');
    }
};
