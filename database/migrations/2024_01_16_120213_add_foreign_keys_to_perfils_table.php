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
        Schema::table('perfils', function (Blueprint $table) {
            $table->foreign(['sistema_id'])->references(['id'])->on('sistemas')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['name_id'])->references(['id'])->on('names')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['tipo_id'])->references(['id'])->on('tipos')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perfils', function (Blueprint $table) {
            $table->dropForeign('perfils_sistema_id_foreign');
            $table->dropForeign('perfils_name_id_foreign');
            $table->dropForeign('perfils_tipo_id_foreign');
        });
    }
};
