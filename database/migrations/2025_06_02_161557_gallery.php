<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gallery', function (Blueprint $table) {
            $table->increments('id_gallery');
            $table->unsignedInteger('id_album');
            $table->string('username', 50);
            $table->string('jdl_gallery', 100);
            $table->string('gallery_seo', 100);
            $table->text('keterangan');
            $table->string('gbr_gallery', 100);
            $table->char('slider', 2)->nullable();

            // Tambahan opsional: timestamps jika dibutuhkan
            // $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery');
    }
};
