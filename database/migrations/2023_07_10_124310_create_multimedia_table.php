<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('multimedia', function (Blueprint $table) {
            $table->id();
            $table->string('tipo')->nullable();
            $table->string('archivo')->nullable();
            $table->bigInteger('producto_id')->unsigned()->nullable();
            $table->foreign('producto_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('multimedia');
    }
};
