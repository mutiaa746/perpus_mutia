<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('cart_id');
            $table->unsignedInteger('peminjam_id');
            $table->dateTime('created_at')->useCurrent();

            $table->foreign('peminjam_id')
                ->references('id')
                ->on('peminjams')
                ->cascadeOnDelete();

            $table->unique(['peminjam_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
