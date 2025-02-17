<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('naskah_id')->references('id')->on('naskah')->cascadeOnDelete();
            $table->string('cover');
            $table->string('isbn')->unique();
            $table->bigInteger('harga');
            $table->integer('jumlah_halaman');
            $table->date('tanggal_terbit');
            $table->string('shopee_link');
            $table->string('tokopedia_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
