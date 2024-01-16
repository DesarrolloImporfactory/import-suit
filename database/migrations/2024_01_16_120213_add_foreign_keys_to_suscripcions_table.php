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
        Schema::table('suscripcions', function (Blueprint $table) {
            $table->foreign(['tipo_id'])->references(['id'])->on('tipos')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['sistema_id'])->references(['id'])->on('sistemas')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['usuario_id'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suscripcions', function (Blueprint $table) {
            $table->dropForeign('suscripcions_tipo_id_foreign');
            $table->dropForeign('suscripcions_sistema_id_foreign');
            $table->dropForeign('suscripcions_usuario_id_foreign');
        });
    }
};
