<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statistik', function (Blueprint $table) {
            $table->string('ip', 20);
            $table->date('tanggal');
            $table->integer('hits')->default(1);
            $table->string('online', 255);
            $table->primary(['ip', 'tanggal']); // gabungan primary key agar tiap IP per tanggal unik
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistik');
    }
};
