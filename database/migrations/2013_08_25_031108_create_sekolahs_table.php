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
        Schema::create('sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kepala_sekolah')->nullable();
            $table->string('npsn');
            $table->string('logo')->default('/img/tutwuri.png');
            $table->foreignId('ref_provinsi_id')->constrained();
            $table->foreignId('ref_kabupaten_id')->constrained();
            $table->foreignId('ref_kecamatan_id')->constrained();
            $table->foreignId('ref_kelurahan_id')->constrained();
            $table->text('jalan');
            $table->enum('tingkat', ['sd', 'smp', 'smk', 'sma']);
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
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
        Schema::dropIfExists('sekolahs');
    }
};
