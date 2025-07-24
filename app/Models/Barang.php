<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barangs';
    protected $fillable = [
        'nama_barang',
        'kategori_id',
        'suplier_id',
        'stok',
        'harga_beli',
        'harga_jual',
        'satuan',
        'deskripsi',
        'foto_barang',
    ];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function suplier()
    {
        return $this->belongsTo(Suplier::class);
    }
    
}