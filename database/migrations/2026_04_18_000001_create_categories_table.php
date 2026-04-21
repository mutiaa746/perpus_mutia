<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Categories', function (Blueprint $table) {
            $table->increments('category_id');
            $table->string('category_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Categories');
    }
};
