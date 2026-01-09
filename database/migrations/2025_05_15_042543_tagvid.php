<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tagvid', function (Blueprint $table) {
            $table->increments('id_tag');
            $table->string('nama_tag', 100);
            $table->string('username', 50);
            $table->string('tag_seo', 100);
            $table->integer('count');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tagvid');
    }
};
