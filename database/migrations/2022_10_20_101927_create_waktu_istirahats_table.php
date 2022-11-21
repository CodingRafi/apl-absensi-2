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
        Schema::create('waktu_istirahats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('waktu_pelajaran_id')->constrained();
            $table->foreignId('sekolah_id')->constrained();
            $table->time('jam_awal')->nullable();
            $table->time('jam_akhir')->nullable();
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
        Schema::dropIfExists('waktu_istirahats');
    }
};
