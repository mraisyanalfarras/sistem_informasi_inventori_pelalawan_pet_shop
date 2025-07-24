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
        Schema::create('stock__masuks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
        $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
        $table->date('tanggal_keluar');
        $table->integer('jumlah');
        $table->text('keterangan')->nullable();
        $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock__masuks');
    }
};
