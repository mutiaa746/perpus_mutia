<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Books', function (Blueprint $table) {
            $table->increments('book_id');
            $table->string('title');
            $table->string('author');
            $table->string('publisher')->nullable();
            $table->year('publication_year')->nullable();
            $table->integer('stock');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('page_count')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->dateTime('created_at')->useCurrent();

            $table->foreign('category_id')
                ->references('category_id')
                ->on('Categories')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Books');
    }
};
