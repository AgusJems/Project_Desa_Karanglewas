<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkhs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('anak');
            $table->string('kendaraan');
            $table->string('pendapatan');
            $table->string('jenis')->nullable();
            $table->string('nominal')->nullable();
            $table->string('status');
            $table->string('tahap1')->nullable();
            $table->string('tahap2')->nullable();
            $table->string('tahap3')->nullable();
            $table->string('tahap4')->nullable();
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
        Schema::dropIfExists('pkhs');
    }
}
