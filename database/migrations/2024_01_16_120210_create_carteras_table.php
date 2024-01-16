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
        Schema::create('carteras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('estado');
            $table->string('detalle', 500)->nullable();
            $table->date('fecha');
            $table->double('saldo', 8, 2);
            $table->unsignedBigInteger('alumno_id')->nullable()->index('carteras_alumno_id_foreign');
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
        Schema::dropIfExists('carteras');
    }
};
