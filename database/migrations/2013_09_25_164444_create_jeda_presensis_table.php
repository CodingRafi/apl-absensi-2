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
        Schema::create('jeda_presensis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->time('jam_masuk');
            $table->time('jam_pulang');
            $table->foreignId('role_id')->nullable();
            $table->foreignId('sekolah_id')->constrained();
            $table->integer('siswa')->nullable(); //todo 0 -> false 1 -> true
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
        Schema::dropIfExists('jeda_presensis');
    }
};
