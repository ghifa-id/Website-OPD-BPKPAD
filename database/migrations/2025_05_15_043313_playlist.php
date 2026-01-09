<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('playlist', function (Blueprint $table) {
            $table->increments('id_playlist');
            $table->string('jdl_playlist', 100);
            $table->string('username', 50);
            $table->string('playlist_seo', 100);
            $table->string('gbr_playlist', 100);
            $table->enum('aktif', ['Y', 'N'])->default('Y');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('playlist');
    }
};
