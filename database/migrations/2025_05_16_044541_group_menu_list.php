<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('group_menu_list', function (Blueprint $table) {
            $table->increments('id_group_menu_list');
            $table->integer('id_group_menu', false, true)->length(5);
            $table->string('nama', 150)->collation('latin1_swedish_ci');
            $table->text('link')->collation('latin1_swedish_ci');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('group_menu_list');
    }
};
