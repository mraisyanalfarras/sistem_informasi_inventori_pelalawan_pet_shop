<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock_Masuk extends Model
{
    use HasFactory;

    protected $table = 'stock_masuks';

    protected $fillable = [
        'barang_id',
        'suplier_id', // tambahkan suplier_id ke fillable
        'tanggal_masuk',
        'jumlah',
        'keterangan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function suplier()
    {
        return $this->belongsTo(Suplier::class);
    }
}
