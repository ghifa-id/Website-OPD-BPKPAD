<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('halaman_statis', function (Blueprint $table) {
            $table->increments('id_halaman');
            $table->string('judul', 100);
            $table->string('judul_seo', 100);
            $table->text('isi_halaman');
            $table->date('tgl_posting');
            $table->string('gambar', 100);
            $table->string('username', 50);
            $table->integer('dibaca')->default(1);
            $table->time('jam');
            $table->string('hari', 20);
        });
    }

    public function down()
    {
        Schema::dropIfExists('halaman_statis');
    }
};
