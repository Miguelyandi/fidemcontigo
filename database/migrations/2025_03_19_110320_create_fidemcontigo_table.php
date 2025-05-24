<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFidemcontigoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fidemcontigo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('documento');
            $table->integer('evo');
            $table->dateTime('fecha');
            $table->dateTime('historia');
            $table->string('apertura');
            $table->text('cuestionario');
            $table->integer('respuesta');
            $table->string('profesional');
            $table->string('apellido');
            $table->string('apellid')->nullable();
            $table->string('nombre');
            $table->string('nombr')->nullable();
            $table->string('eps');
            $table->string('tel', 20);
            $table->string('medicamentos');
            $table->string('nombreMedicamento');
            $table->string('observacion');
            $table->date('fechaIngreso');
            $table->date('fechaEgreso');
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
        Schema::dropIfExists('fidemcontigo');
    }
}
