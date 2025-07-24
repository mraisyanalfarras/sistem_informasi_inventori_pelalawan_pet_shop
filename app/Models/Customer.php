<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
     protected $fillable = ['nama_customer', 'alamat', 'telepon', 'email'];

    public function stokKeluars()
    {
        return $this->hasMany(Stok_Keluar::class);
    }
}
