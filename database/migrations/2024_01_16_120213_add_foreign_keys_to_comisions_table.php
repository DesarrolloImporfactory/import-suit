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
        Schema::table('comisions', function (Blueprint $table) {
            $table->foreign(['tipo_id'])->references(['id'])->on('tipo_comisions')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['cartera_id'])->references(['id'])->on('carteras')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['vendedor_id'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comisions', function (Blueprint $table) {
            $table->dropForeign('comisions_tipo_id_foreign');
            $table->dropForeign('comisions_cartera_id_foreign');
            $table->dropForeign('comisions_vendedor_id_foreign');
        });
    }
};
