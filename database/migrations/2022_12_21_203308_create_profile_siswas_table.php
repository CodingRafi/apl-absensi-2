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
        Schema::create('profile_siswas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nisn')->unique();
            $table->string('nik');
            $table->enum('jk', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('kompetensi_id')->nullable()->constrained();
            $table->foreignId('ref_agama_id')->nullable()->contrained();
            $table->foreignId('ref_provinsi_id')->nullable()->constrained();
            $table->foreignId('ref_kabupaten_id')->nullable()->constrained();
            $table->foreignId('ref_kecamatan_id')->nullable()->constrained();
            $table->foreignId('ref_kelurahan_id')->nullable()->constrained();
            // $table->foreignId('tahun_ajaran_id')->constrained();
            $table->string('jalan');
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
        Schema::dropIfExists('profile_siswas');
    }
};
