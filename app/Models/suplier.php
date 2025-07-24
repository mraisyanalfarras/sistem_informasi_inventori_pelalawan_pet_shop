<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suplier extends Model
{
    use HasFactory;
    protected $fillable = ['nama_suplier', 'alamat', 'telepon', 'email'];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
