<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       chema::create('ordenes_medicamentos_filtradas', function (Blueprint $table) {
        $table->id(); // ID autoincremental de Laravel
        $table->unsignedBigInteger('id_evolucion');
        $table->string('causa')->nullable();
        $table->string('codigo')->nullable();
        $table->string('presentacion')->nullable();
        $table->string('nombre')->nullable();
        $table->integer('cantidad')->nullable();
        $table->string('administracion')->nullable();
        $table->decimal('dosis_cant', 8, 2)->nullable();
        $table->integer('dosis_freq')->nullable();
        $table->string('dosis_hora')->nullable(); // puede ser string si es tipo hora
        $table->integer('numero_dosis')->nullable();
        $table->string('posologia')->nullable();
        $table->text('observaciones')->nullable();

        $table->timestamps(); // created_at y updated_at
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicamentos');
    }
}
