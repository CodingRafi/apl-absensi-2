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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nisn');
            $table->string('nipd');
            $table->enum('jk', ['L', 'P'])->nullable();
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->foreignId('kelas_id')->constrained();
            $table->foreignId('kompetensi_id')->constrained();
            $table->string('nik');
            $table->string('agama');
            $table->string('jalan');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->foreignId('sekolah_id')->constrained();
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
        Schema::dropIfExists('siswas');
    }
};
