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
        Schema::table('abonos', function (Blueprint $table) {
            $table->foreign(['forma_id'])->references(['id'])->on('formas')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['cartera_id'])->references(['id'])->on('carteras')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('abonos', function (Blueprint $table) {
            $table->dropForeign('abonos_forma_id_foreign');
            $table->dropForeign('abonos_cartera_id_foreign');
        });
    }
};
