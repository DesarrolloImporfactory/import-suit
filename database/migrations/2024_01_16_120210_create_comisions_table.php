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
        Schema::create('comisions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('valor', 8, 2)->nullable();
            $table->unsignedBigInteger('cartera_id')->nullable()->index('comisions_cartera_id_foreign');
            $table->unsignedBigInteger('vendedor_id')->nullable()->index('comisions_vendedor_id_foreign');
            $table->unsignedBigInteger('tipo_id')->nullable()->index('comisions_tipo_id_foreign');
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
        Schema::dropIfExists('comisions');
    }
};
