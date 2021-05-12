<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCalificacionesPeriodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificaciones_periodos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->decimal('calificacionA:')->nullable();
            $table->decimal('calificacionB')->nullable();
            $table->integer('promedio')->nullable();
            $table->integer('faltas')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('calificaciones_periodos');
    }
}
