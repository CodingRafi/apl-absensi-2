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
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('absensi_pelajaran_id')->constrained();
            $table->foreignId('siswa_id')->constrained();
            $table->foreignId('absensi_id')->constrained();
            $table->date('tgl_kehadiran');
            $table->enum('kehadiran', ['hadir', 'sakit', 'izin', 'alpha']);
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
        Schema::dropIfExists('presensis');
    }
};
