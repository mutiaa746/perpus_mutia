<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('borrowing_items', function (Blueprint $table) {
            $table->increments('borrow_item_id');
            $table->unsignedInteger('borrow_id');
            $table->unsignedInteger('book_id');
            $table->unsignedInteger('quantity')->default(1);

            $table->foreign('borrow_id')
                ->references('borrow_id')
                ->on('borrowings')
                ->cascadeOnDelete();

            $table->foreign('book_id')
                ->references('book_id')
                ->on('Books')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrowing_items');
    }
};
