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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('session')->nullable()->useCurrent();
            $table->string('name')->nullable();
            $table->string('telefono')->nullable();
            $table->string('date')->nullable();
            $table->string('importacion')->nullable();
            $table->string('idioma')->nullable();
            $table->string('estado')->nullable();
            $table->string('cedula')->nullable();
            $table->string('ruc')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->timestamp('two_factor_confirmed_at')->nullable();
            $table->string('url', 500)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedBigInteger('perfil_id')->nullable()->index('users_perfil_id_foreign');
            $table->string('NOMBRE', 50)->nullable();
            $table->string('CORREO', 50)->nullable();
            $table->string('PASWORD', 50)->nullable();
            $table->string('stripe_id')->nullable()->index();
            $table->string('pm_type')->nullable();
            $table->string('pm_last_four', 4)->nullable();
            $table->timestamp('trial_ends_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
