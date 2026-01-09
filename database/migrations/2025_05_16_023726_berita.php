<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->increments('id_berita');
            $table->integer('id_kategori')->unsigned();
            $table->string('username', 30);
            $table->string('judul', 120);
            $table->string('sub_judul', 100);
            $table->string('youtube', 100);
            $table->string('judul_seo', 100);
            $table->enum('headline', ['Y', 'N'])->default('Y');
            $table->enum('aktif', ['Y', 'N'])->default('Y');
            $table->enum('utama', ['Y', 'N'])->default('Y');
            $table->longText('isi_berita');
            $table->text('keterangan_gambar');
            $table->string('hari', 20);
            $table->date('tanggal');
            $table->time('jam');
            $table->string('gambar', 100);
            $table->integer('dibaca')->default(1);
            $table->string('tag', 100);
            $table->enum('status', ['Y', 'N'])->default('Y');
            $table->char('id_opd', 2)->nullable()->default('7');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
