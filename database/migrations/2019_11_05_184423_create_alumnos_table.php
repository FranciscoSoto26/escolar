<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->string('matricula');
            $table->string('apaterno');
            $table->integer('amaterno');
            $table->string('nombre');
            $table->string('sexo');
            $table->string('curp');
            $table->string('fecha_nacimiento')->nullable();
            $table->string('correo_electronico');
            $table->string('estado');
            $table->string('nuevo_ingreso');
            $table->string('fecha_ingreso');
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
        Schema::dropIfExists('alumnos');
    }
}
