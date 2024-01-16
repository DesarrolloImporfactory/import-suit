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
        Schema::create('abonos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->string('archivo')->nullable();
            $table->double('valor', 8, 2);
            $table->unsignedBigInteger('forma_id')->nullable()->index('abonos_forma_id_foreign');
            $table->unsignedBigInteger('cartera_id')->nullable()->index('abonos_cartera_id_foreign');
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
        Schema::dropIfExists('abonos');
    }
};
