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
        Schema::create('ciudad_laar', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ciudad');
            $table->string('codigo', 50)->nullable();
            $table->string('nombre', 150)->nullable();
            $table->string('trayecto', 10)->nullable();
            $table->string('provincia', 100)->nullable();
            $table->string('codigoProvincia', 100)->nullable();
            $table->string('codigor', 100)->nullable();
            $table->string('tipo', 100)->nullable();
            $table->double('costo')->nullable();
            $table->double('precio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ciudad_laar');
    }
};
