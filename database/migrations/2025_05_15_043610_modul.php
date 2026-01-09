<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modul', function (Blueprint $table) {
            $table->increments('id_modul');
            $table->string('nama_modul', 50);
            $table->string('username', 50);
            $table->string('link', 100); 
            $table->text('static_content'); 
            $table->string('gambar', 100); 
            $table->enum('publish', ['Y', 'N'])->default('Y'); 
            $table->enum('status', ['user', 'admin']); 
            $table->enum('aktif', ['Y', 'N'])->default('Y'); 
            $table->integer('urutan'); 
            $table->string('link_seo', 50);
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modul');
    }
};
