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
        Schema::create('barangs', function (Blueprint $table) {
        $table->id();
        $table->string('nama_barang');
        $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
        $table->foreignId('suplier_id')->constrained('supliers')->onDelete('cascade');
        $table->integer('stok')->default(0);
        $table->integer('harga_beli');
        $table->integer('harga_jual');
        $table->string('satuan');
        $table->text('deskripsi')->nullable();
        $table->string('foto_barang')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
