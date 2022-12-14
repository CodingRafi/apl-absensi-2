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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('mapel_id')->nullable()->constrained();
            $table->foreignId('kelas_id')->nullable()->constrained();
            $table->foreignId('tahun_ajaran_id')->constrained();
            $table->foreignId('waktu_pelajaran_id')->constrained();
            $table->text('other')->nullable();
            $table->enum('hari', config('services.hari.value'));
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
        Schema::dropIfExists('agendas');
    }
};
