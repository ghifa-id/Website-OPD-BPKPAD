<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('album', function (Blueprint $table) {
            $table->increments('id_album');
            $table->string('jdl_album', 100);
            $table->string('album_seo', 100);
            $table->text('keterangan');
            $table->string('gbr_album', 100);
            $table->enum('aktif', ['Y', 'N'])->default('Y');
            $table->integer('hits_album')->default(1);
            $table->date('tgl_posting');
            $table->time('jam');
            $table->string('hari', 20);
            $table->string('username', 50);
            $table->date('tgl_kegiatan');
            $table->string('tempat', 200);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('album');
    }
};
