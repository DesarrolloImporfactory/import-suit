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
        Schema::create('clientes', function (Blueprint $table) {
            $table->integer('id_cliente');
            $table->string('nombre_cliente');
            $table->string('fiscal_cliente');
            $table->char('telefono_cliente', 30);
            $table->string('email_cliente', 64);
            $table->string('direccion_cliente');
            $table->tinyInteger('status_cliente')->default(1);
            $table->dateTime('date_added');
            $table->string('razon_social', 1000);
            $table->string('nombre_contacto', 1500)->nullable();
            $table->string('telefono_contacto', 1500)->nullable();
            $table->string('cargo_contacto', 1500)->nullable();
            $table->string('observaciones', 2500)->nullable();
            $table->integer('dias_credito');
            $table->string('giro_negocio', 1500)->nullable();
            $table->string('ciudad', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
