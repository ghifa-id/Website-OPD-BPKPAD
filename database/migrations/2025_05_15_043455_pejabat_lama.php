<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pejabat_lama', function (Blueprint $table) {
            $table->increments('id_pejabat'); // int(5), auto_increment primary key
            $table->string('jdl_pejabat', 100); // varchar(100), NOT NULL
            $table->string('pejabat_seo', 100); // varchar(100), NOT NULL
            $table->text('keterangan'); // text, NOT NULL
            $table->string('gbr_pejabat', 100); // varchar(100), NOT NULL
            $table->enum('aktif', ['Y', 'N'])->default('Y'); // enum('Y','N'), default 'Y'
            $table->integer('hits_pejabat')->default(1); // int(5), default 1
            $table->date('tgl_posting'); // date, NOT NULL
            $table->time('jam'); // time, NOT NULL
            $table->string('hari', 20); // varchar(20), NOT NULL
            $table->string('username', 50); // varchar(50), NOT NULL
            $table->string('nama_pejabat', 500); // varchar(500), NOT NULL
            $table->timestamps(); // optional, created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pejabat');
    }
};
