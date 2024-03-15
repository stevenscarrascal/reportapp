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
        Schema::create('reportes', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('personal_id',125);
            $table->string('contrato',125);
            $table->string('lectura',125);
            $table->string('direccion')->nullable();
            $table->string('anomalia');
            $table->string('imposibilidad')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('foto1');
            $table->string('foto2');
            $table->string('foto3');
            $table->string('foto4');
            $table->string('foto5')->nullable();
            $table->string('foto6')->nullable();
            $table->unsignedInteger('localizacion')->nullable();
            $table->foreign('localizacion')->references('id')->on('localizaciones')->delete('cascade');
            $table->string('estado')->default('7');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
