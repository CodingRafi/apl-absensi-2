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
        Schema::create('profile_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->enum('jk', ['L', 'P'])->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->foreignId('ref_agama_id')->nullable()->constrained();
            $table->foreignId('ref_provinsi_id')->nullable()->constrained();
            $table->foreignId('ref_kabupaten_id')->nullable()->constrained();
            $table->foreignId('ref_kecamatan_id')->nullable()->constrained();
            $table->foreignId('ref_kelurahan_id')->nullable()->constrained();
            $table->string('jalan')->nullable();
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
        Schema::dropIfExists('profile_users');
    }
};
