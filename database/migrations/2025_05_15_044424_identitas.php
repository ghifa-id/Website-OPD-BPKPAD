<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('identitas', function (Blueprint $table) {
            $table->increments('id_identitas');
            $table->string('nama_website', 100);
            $table->string('email', 100);
            $table->string('url', 100);
            $table->text('facebook');
            $table->string('no_telp', 20);
            $table->text('meta_deskripsi');
            $table->string('meta_keyword', 250);
            $table->string('favicon', 50);
            $table->text('maps');
            $table->text('keterangan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('identitas');
    }
};
