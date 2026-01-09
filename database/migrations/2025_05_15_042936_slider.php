<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('slider', function (Blueprint $table) {
            $table->increments('id_slider'); // auto_increment primary key
            $table->string('slider_seo', 100);
            $table->string('jdl_slider', 100);
            $table->string('url', 200);
            $table->string('gbr_slider', 100);
            $table->string('username', 50)->nullable();
            $table->timestamps(); // jika ingin created_at & updated_at, opsional
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slider');
    }
};
