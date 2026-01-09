<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wisata', function (Blueprint $table) {
            $table->increments('id_wisata');
            $table->string('nama', 100)->nullable();
            $table->string('foto1', 100)->nullable();
            $table->string('ket1', 50)->nullable();
            $table->string('foto2', 100)->nullable();
            $table->string('ket2', 50)->nullable();
            $table->string('foto3', 100)->nullable();
            $table->string('ket3', 50)->nullable();
            $table->string('foto4', 100)->nullable();
            $table->string('ket4', 50)->nullable();
            $table->string('foto5', 100)->nullable();
            $table->string('ket5', 50)->nullable();
            $table->string('foto6', 100)->nullable();
            $table->string('ket6', 50)->nullable();
            $table->string('video', 100)->nullable();
            $table->binary('deskripsi')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wisata');
    }
};
