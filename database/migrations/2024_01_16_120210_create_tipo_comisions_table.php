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
        Schema::create('tipo_comisions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('valor', 11);
            $table->unsignedBigInteger('vendedor_id')->nullable()->index('tipo_comisions_vendedor_id_foreign');
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
        Schema::dropIfExists('tipo_comisions');
    }
};
