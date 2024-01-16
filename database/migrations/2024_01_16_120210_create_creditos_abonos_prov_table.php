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
        Schema::create('creditos_abonos_prov', function (Blueprint $table) {
            $table->integer('id_abono');
            $table->string('numero_factura', 20);
            $table->dateTime('fecha_abono');
            $table->integer('id_proveedor');
            $table->double('monto_abono');
            $table->double('abono');
            $table->double('saldo_abono');
            $table->integer('id_users_abono');
            $table->integer('id_sucursal');
            $table->string('concepto_abono');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creditos_abonos_prov');
    }
};
