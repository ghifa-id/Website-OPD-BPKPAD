<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('komentar', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_berita'); // GANTI dari unsignedBigInteger menjadi unsignedInteger
            $table->string('nama_pengguna');
            $table->string('email');
            $table->text('isi_komentar');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('id_berita')->references('id_berita')->on('berita')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komentar');
    }
};