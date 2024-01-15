<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('suscripcions', function (Blueprint $table) {
            $table->id();
            //user
            $table->bigInteger('usuario_id')->unsigned()->nullable();
            $table->foreign('usuario_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            //sistemas
            $table->bigInteger('sistema_id')->unsigned()->nullable();
            $table->foreign('sistema_id')->references('id')->on('sistemas')->onUpdate('cascade')->onDelete('cascade');
            //tipo
            $table->bigInteger('tipo_id')->unsigned()->nullable();
            $table->foreign('tipo_id')->references('id')->on('tipos')->onUpdate('cascade')->onDelete('cascade');

            $table->enum('estado', ['Activa', 'Caducada'])->default('Activa');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('suscripcions');
    }
};
