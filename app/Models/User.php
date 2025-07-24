<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;


    protected $fillable = [
        'nik', // Tambahkan NIK agar bisa diinput
        'name',
        'email',
        'password',
        'tanggal',
        'position',
        'masuk_jadwal',
        'kecelakaan',
        'mulai_kerja',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'tanggal' => 'date',
        'mulai_kerja' => 'date',
    ];

    public function datasios()
    {
        return $this->hasMany(DataSio::class, 'user_id');
    }

    public function datasims()
    {
        return $this->hasMany(DataSim::class, 'user_id');
    }
    public function dataSirs()
{
    return $this->hasMany(DataSir::class, 'user_id');
}

}
