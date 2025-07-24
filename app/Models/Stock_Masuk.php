<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok_masuk extends Model
{
    use HasFactory;
     protected $fillable = ['barang_id', 'tanggal_masuk', 'jumlah', 'keterangan'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
