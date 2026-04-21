<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->unsignedTinyInteger('umur');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('nomor_hp');
            $table->string('email')->unique();
            $table->text('alamat');
            $table->string('foto')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('nim')->unique();
            $table->enum('verifikasi', ['terdaftar', 'belum_terdaftar'])->default('belum_terdaftar');
            $table->string('password');
            $table->dateTime('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjams');
    }
};
