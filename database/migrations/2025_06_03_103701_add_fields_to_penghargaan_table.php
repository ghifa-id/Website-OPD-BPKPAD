<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPenghargaanTable extends Migration
{
    public function up()
    {
        Schema::table('penghargaan', function (Blueprint $table) {
            $table->date('tgl_posting')->nullable()->after('tingkat');
            $table->string('username', 50)->after('gambar');
            $table->integer('dibaca')->default(1)->after('username');
            $table->time('jam')->after('dibaca');
        });
    }

    public function down()
    {
        Schema::table('penghargaan', function (Blueprint $table) {
            $table->dropColumn(['tgl_posting', 'username', 'dibaca', 'jam']);
        });
    }
}
