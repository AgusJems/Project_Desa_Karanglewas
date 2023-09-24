<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenduduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->string('tptLahir')->nullable();
            $table->string('tglLahir')->nullable();
            $table->string('kelamin')->nullable();
            $table->string('kawin')->nullable();
            $table->string('agama')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('akta')->unique()->nullable();
            $table->string('pam')->nullable();
            $table->string('regis')->nullable();
            $table->boolean('isPenduduk')->default(false);
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
        Schema::dropIfExists('penduduks');
    }
}
