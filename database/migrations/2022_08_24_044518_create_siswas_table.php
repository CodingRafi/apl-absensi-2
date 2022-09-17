<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migdarations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('profil')->default('/img/profil.png');
            $table->string('name');
            $table->string('nisn')->unique();
            $table->string('nipd')->unique();
            $table->string('email')->nullable()->unique();
            $table->string('password')->default('$2a$12$EJoe7nRx6rAnP6nwwVGzrOvKIyMVS6svFk5/vZMCvufgr2IMBQtuS');
            $table->enum('jk', ['L', 'P'])->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir')->nullable();
            $table->foreignId('kelas_id')->constrained();
            $table->foreignId('kompetensi_id')->nullable()->constrained();
            $table->foreignId('jeda_presensi_id')->nullable()->constrained();
            $table->string('nik')->unique();
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
