<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ForeignKeyDefinition;
use Illuminate\Support\Facades\Schema;

class CreateCalificacionCurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificacion_curso', function (Blueprint $table) {
            $table->increments('id')->lenght(11);
            $table->Integer('idcurso')->lenght(11);
            $table->Integer('idusuario')->lenght(11);
            $table->Integer('pregunta1')->lenght(1);
            $table->Integer('pregunta2')->lenght(1);
            $table->Integer('pregunta3')->lenght(1);
            $table->Integer('pregunta4')->lenght(1);
            $table->Integer('pregunta5')->lenght(1);
            $table->string('pregunta6', 150);
            $table->Integer('pregunta7')->lenght(1);
            $table->Integer('pregunta8')->lenght(1);
            $table->Integer('pregunta9')->lenght(1);
            $table->Integer('pregunta10')->lenght(1);
            $table->double('promedioCalificacion',3,2);
            $table->timestamps();
            
            $table->foreign('idCurso')->references('idcurso')->on('curso');
            $table->foreign('idUsuario')->references('idusuario')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calificacion_curso');
    }
}
