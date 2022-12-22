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
            $table->id();
            $table->string('profil')->default('/img/profil.png');
            $table->string('email')->unique()->nullable();
            $table->string('nip')->unique()->nullable();
            $table->string('nipd')->unique()->nullable();
            $table->string('password')->default('$2a$12$xe6Cjkp24m/CqF.m9C2y2.AivndWosItFUk.1d8Pqb7WCt6Vxk8wS');
            $table->foreignId('sekolah_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
