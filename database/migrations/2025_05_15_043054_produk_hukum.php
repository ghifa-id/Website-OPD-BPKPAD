<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk_hukum', function (Blueprint $table) {
            $table->increments('id_produk_hukum');
            $table->string('judul', 200)->nullable();
            $table->string('ket', 200)->nullable();
            $table->string('nama_file', 100)->nullable();
            $table->date('tgl_posting')->nullable();
            $table->integer('hits', false, true)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_hukum');
    }
};
