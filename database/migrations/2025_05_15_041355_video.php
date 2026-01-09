<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('video', function (Blueprint $table) {
            $table->id('id_video'); // int auto increment primary key
            $table->integer('id_playlist');
            $table->string('username', 30);
            $table->string('jdl_video', 100);
            $table->string('video_seo', 100);
            $table->text('keterangan');
            $table->string('gbr_video', 100);
            $table->string('video', 100);
            $table->string('youtube', 100);
            $table->integer('dilihat')->default(1);
            $table->string('hari', 20);
            $table->date('tanggal');
            $table->time('jam');
            $table->string('tagvid', 100);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video');
    }
};
