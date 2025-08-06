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
        Schema::create('customers', function (Blueprint $table) {
          $table->id();
        $table->string('kode_customer')->unique(); // Tambahan kode unik customer
        $table->string('nama_customer');
        $table->text('alamat');
        $table->string('telepon');
        $table->string('email')->nullable();
        $table->enum('jenis_kelamin', ['Pria', 'Perempuan'])->nullable(); // Tambahan untuk identitas
        
        $table->text('catatan')->nullable(); // Catatan tambahan customer
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
