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
        Schema::create('comprobantes_sri', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('id_comprobante')->nullable();
            $table->integer('id_factura')->nullable();
            $table->integer('id_guia')->nullable();
            $table->integer('id_retencion')->nullable();
            $table->integer('id_credito')->nullable();
            $table->integer('id_debito')->nullable();
            $table->integer('id_liquidacion')->nullable();
            $table->string('tipo', 50)->nullable();
            $table->string('claveAcceso', 50)->nullable();
            $table->string('Estado', 50)->nullable();
            $table->string('Mensaje', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comprobantes_sri');
    }
};
