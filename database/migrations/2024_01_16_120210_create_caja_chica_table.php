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
        Schema::create('caja_chica', function (Blueprint $table) {
            $table->integer('id_caja');
            $table->string('referencia_caja');
            $table->double('monto_caja');
            $table->string('descripcion_caja');
            $table->tinyInteger('tipo_caja');
            $table->integer('users_caja');
            $table->dateTime('date_added_caja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caja_chica');
    }
};
