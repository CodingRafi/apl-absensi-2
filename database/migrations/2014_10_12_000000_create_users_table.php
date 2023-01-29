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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('profil')->default('/img/profil.png');
            $table->string('email')->unique()->nullable();
            $table->string('nip')->unique()->nullable();
            $table->string('nipd')->unique()->nullable();
            $table->string('password')->default('$2a$12$5o5olF8lR9ySHktv1wpxQ.OHLmSLFXHt7ZYQxkN9QFfjJgE5v2bty');
            $table->foreignId('sekolah_id')->nullable()->constrained();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
