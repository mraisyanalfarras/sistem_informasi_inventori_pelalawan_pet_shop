<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok_keluar extends Model
{
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
