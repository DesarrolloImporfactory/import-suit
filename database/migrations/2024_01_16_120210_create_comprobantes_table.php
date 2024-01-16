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
        Schema::create('comprobantes', function (Blueprint $table) {
            $table->integer('id_comp');
            $table->string('nombre_comp', 100);
            $table->string('serie_comp', 100);
            $table->integer('desde_comp');
            $table->integer('hasta_comp');
            $table->integer('long_comp');
            $table->integer('actual_comp');
            $table->date('vencimiento_comp');
            $table->integer('estado_comp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comprobantes');
    }
};
