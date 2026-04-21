<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->increments('cart_item_id');
            $table->unsignedInteger('cart_id');
            $table->unsignedInteger('book_id');
            $table->unsignedInteger('quantity')->default(1);

            $table->foreign('cart_id')
                ->references('cart_id')
                ->on('carts')
                ->cascadeOnDelete();

            $table->foreign('book_id')
                ->references('book_id')
                ->on('Books')
                ->restrictOnDelete();

            $table->unique(['cart_id', 'book_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
