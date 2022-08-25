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
        Schema::create('tahun_ajarans', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun_awal');
            $table->integer('tahun_akhir');
            $table->enum('semester', ['ganjil', 'genap']);
            $table->enum('status', ['aktif', 'tidak']);
            $table->enum('sekolah', ['smp', 'smk']);
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
        Schema::dropIfExists('tahun_ajarans');
    }
};
