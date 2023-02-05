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
        Schema::create('ref_tingkats', function (Blueprint $table) {
            $table->id();
            $table->integer('key');
            $table->string('romawi');
            $table->timestamps();
        });

        Schema::create('sekolah_tingkat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ref_tingkat_id')->constrained();
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
        Schema::dropIfExists('ref_tingkats');
        Schema::dropIfExists('sekolah_tingkat');
    }
};
