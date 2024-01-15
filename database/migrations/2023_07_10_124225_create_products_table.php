<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('proveedor_id')->unsigned()->nullable();
            $table->foreign('proveedor_id')->references('id')->on('providers')->onUpdate('cascade')->onDelete('cascade');
            //table category
            $table->bigInteger('categoria_id')->unsigned()->nullable();
            $table->foreign('categoria_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
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

    
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
