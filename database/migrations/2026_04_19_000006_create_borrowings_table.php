<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->increments('borrow_id');
            $table->unsignedInteger('peminjam_id');
            $table->dateTime('borrow_date')->useCurrent();
            $table->dateTime('return_date')->nullable();
            $table->enum('status', ['pending', 'approved', 'returned'])->default('pending');
            $table->unsignedInteger('admin_id')->nullable();
            $table->text('note')->nullable();

            $table->foreign('peminjam_id')
                ->references('id')
                ->on('peminjams')
                ->cascadeOnDelete();

            $table->foreign('admin_id')
                ->references('id_admin')
                ->on('admins')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
