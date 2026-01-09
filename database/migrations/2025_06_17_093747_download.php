<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('download', function (Blueprint $table) {
            $table->increments('id_download');
            $table->string('judul', 100)->charset('latin1')->collation('latin1_general_ci');
            $table->string('nama_file', 100)->charset('latin1')->collation('latin1_general_ci');
            $table->date('tgl_posting');
            $table->integer('hits')->length(3);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('download');
    }
};
