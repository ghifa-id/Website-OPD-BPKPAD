<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id_menu');
            $table->integer('id_parent')->default(0);
            $table->string('nama_menu', 50);
            $table->string('link', 100);
            $table->enum('aktif', ['Ya', 'Tidak'])->default('Ya');
            $table->enum('position', ['Top', 'Bottom'])->default('Bottom');
            $table->integer('urutan', false, true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
