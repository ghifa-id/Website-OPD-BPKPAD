<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dokperenlitbang', function (Blueprint $table) {
            $table->increments('id_dokperenlitbang');
            $table->date('tgl_posting')->nullable();
            $table->integer('hits')->nullable();
            $table->string('nama_file', 300)->nullable();
            $table->string('jenis', 300)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokperenlitbang');
    }
};
