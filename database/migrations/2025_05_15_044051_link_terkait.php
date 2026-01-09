<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('link_terkait', function (Blueprint $table) {
            $table->increments('id_link_terkait');
            $table->string('judul_menu', 255);
            $table->text('detail_menu');
            $table->text('link');
            $table->string('username', 100);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('link_terkait');
    }
};
