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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('Nama_Produk');
            $table->integer('Harga_Produk');
            $table->string('Tipe_Produk');
            $table->text('Detail_Produk')->nullable();
            $table->string('Kategori_Produk');
            $table->string('Foto_Produk')->nullable();
            $table->integer('Diskon')->default(0);
            $table->integer('Harga_Diskon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
