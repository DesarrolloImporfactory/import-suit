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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('proveedor_id')->nullable()->index('products_proveedor_id_foreign');
            $table->unsignedBigInteger('categoria_id')->nullable()->index('products_categoria_id_foreign');
            $table->string('name');
            $table->string('enlace');
            $table->string('description')->nullable();
            $table->string('estado')->nullable();
            $table->double('price_china', 8, 2);
            $table->double('price_latam', 8, 2);
            $table->double('price_mayor', 8, 2);
            $table->double('price_public', 8, 2);
            $table->string('photo');
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
        Schema::dropIfExists('products');
    }
};
