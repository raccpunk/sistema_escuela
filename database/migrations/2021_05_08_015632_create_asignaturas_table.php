<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAsignaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignaturas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre:')->nullable();
            $table->integer('creditos:')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('asignaturas');
    }
}
