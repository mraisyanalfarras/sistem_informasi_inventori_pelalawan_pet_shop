<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock_Keluar extends Model
{
    protected $table = 'stock_keluars';
    use HasFactory;
    protected $fillable = ['barang_id', 'customer_id', 'tanggal_keluar', 'jumlah', 'keterangan'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
