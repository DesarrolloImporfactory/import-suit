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
        Schema::create('creditos', function (Blueprint $table) {
            $table->integer('id_credito');
            $table->string('numero_factura', 20);
            $table->dateTime('fecha_credito');
            $table->integer('id_cliente');
            $table->integer('id_vendedor');
            $table->double('monto_credito');
            $table->double('saldo_credito');
            $table->boolean('estado_credito');
            $table->integer('id_users_credito');
            $table->integer('id_sucursal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creditos');
    }
};
