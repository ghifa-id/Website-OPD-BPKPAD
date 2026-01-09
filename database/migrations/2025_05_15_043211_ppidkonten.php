<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppidkonten', function (Blueprint $table) {
            $table->increments('id_ppidkonten'); // int(5), auto_increment primary key
            $table->date('tgl_posting')->nullable(); // date, nullable
            $table->integer('hits', false, true)->nullable(); // int(3), unsigned, nullable
            $table->string('nama_file', 300)->nullable(); // varchar(300), nullable
            $table->string('jenis', 300)->nullable(); // varchar(300), nullable
            $table->timestamps(); // opsional, kalau ingin created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppidkonten');
    }
};
