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
            $table->string('jam_masuk');
            $table->string('jam_pulang');
            $table->foreignId('role_id')->nullable()->constrained();
            $table->foreignId('sekolah_id')->constrained();
            $table->enum('siswa', ['0', '1'])->nullable(); //todo 0 -> false 1 -> true
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
