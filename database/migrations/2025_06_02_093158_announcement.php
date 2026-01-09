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
        Schema::create('announcement', function (Blueprint $table) {
            $table->increments('id_announcement');
            $table->string('judul', 255)->collation('latin1_swedish_ci');
            $table->string('judul_seo', 255)->collation('latin1_swedish_ci');
            $table->string('perihal', 255)->collation('latin1_swedish_ci');
            $table->text('deskripsi_pengumuman')->collation('latin1_swedish_ci');
            $table->date('deadline');
            $table->text('keterangan')->collation('latin1_swedish_ci');
            $table->string('file_pendukung', 255)->collation('latin1_swedish_ci');
            $table->date('tanggal_posting');
            $table->string('username', 100)->collation('latin1_swedish_ci');
            $table->integer('dibaca')->default(1);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcement');
    }
};
