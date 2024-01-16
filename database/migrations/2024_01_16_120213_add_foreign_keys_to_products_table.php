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
        Schema::table('products', function (Blueprint $table) {
            $table->foreign(['proveedor_id'])->references(['id'])->on('providers')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['categoria_id'])->references(['id'])->on('categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_proveedor_id_foreign');
            $table->dropForeign('products_categoria_id_foreign');
        });
    }
};
