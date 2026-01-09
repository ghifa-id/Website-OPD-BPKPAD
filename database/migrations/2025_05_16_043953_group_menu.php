<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('group_menu', function (Blueprint $table) {
            $table->increments('id_group_menu');
            $table->string('nama_group_menu', 100);
        });
    }


    public function down()
    {
        Schema::dropIfExists('group_menu');
    }
};
