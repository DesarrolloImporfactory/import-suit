<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suscripcions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('usuario_id')->nullable()->index('suscripcions_usuario_id_foreign');
            $table->unsignedBigInteger('sistema_id')->nullable()->index('suscripcions_sistema_id_foreign');
            $table->unsignedBigInteger('tipo_id')->nullable()->index('suscripcions_tipo_id_foreign');
            $table->enum('estado', ['Activa', 'Caducada'])->default('Activa');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
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
        Schema::dropIfExists('suscripcions');
    }
};
