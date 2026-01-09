<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transparasi', function (Blueprint $table) {
            $table->increments('id_transparasi');
            $table->string('judul', 100)->nullable();
            $table->string('nama_file', 100)->nullable();
            $table->date('tgl_posting')->nullable();
            $table->integer('hits')->nullable();
            $table->string('tahun', 4)->nullable();
            $table->string('opd', 100)->nullable();
            $table->string('jenis', 100)->nullable();
            $table->char('id_kat', 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transparasi');
    }
};
